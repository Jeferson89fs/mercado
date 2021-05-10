<?php

namespace App\Model;

use Exception;
use App\Model\Conexao;
use App\ModelzVenda_item;
use Src\Classes\Utils;

class Venda
{
    private $id_venda;
    private $nr_valor_venda;
    private $dt_cadastro;

    public function getId_venda(){ return $this->id_venda;}
    public function getNr_valor_venda(){ return $this->nr_valor_venda;}
    public function getDt_cadastro(){ return $this->dt_cadastro;}
    public function getDt_cadastro_br(){ 
        $date = new \DateTime(  $this->dt_cadastro );
        $hora = new \DateTime(  $this->dt_cadastro );
        return $date->format( 'd-m-Y H:i:s' );         
    }
    
    public function getTotal_itens(){ 
        if($this->id_venda){
            $Venda_item = new Venda_item();
            $Venda_item->setId_venda($this->id_venda);
            return count($Venda_item->listar());
        }
        
    }
    
    public function setId_venda($x){ $this->id_venda = $x;}
    public function setNr_valor_venda($x){ $this->nr_valor_venda = $x ? Utils::mostraValor($x) : $x;}
    public function setDt_cadastro($x){ $this->dt_cadastro = $x;}

    public function validaDados($acao = '')
    {
        $msg_erro = '';
        if ($acao == 'inserir'  || $acao == 'alterar') {
          
        }

        return $msg_erro;
    }

    public function inserir()
    {
        $db = Conexao::conecta();

        try {

            $sql = " insert into vendas.venda ( id_venda,
                                                nr_valor_venda ,
                                                dt_cadastro 
                                               )values(
                                                nextval('vendas.venda_id_venda_seq'), 
                                                '" . Utils::formataValor($this->getNr_valor_venda()) . "',
                                                now() ) ";
                                                
            $res = $db->prepare($sql);
            $res->execute();

            $sql = "select currval('vendas.venda_id_venda_seq') as id_venda ";
            
            $res = $db->prepare($sql);
            $res->execute();
            $obj = $res->fetch(\PDO::FETCH_OBJ);
            return $obj->id_venda;

        } catch (\PDOException $e) {

            return false;
        }

        return true;
    }

    public function listar()
    {
        $db = Conexao::conecta();

        try {

            $sql = " select * from vendas.venda where 1=1 ";

            if ($this->getId_venda()) 
                $sql .= " and id_venda = " . $this->getId_venda();
            
            if ($this->getNr_valor_venda()) 
                $sql .= " and nr_valor_venda = " . Utils::formataValor($this->getNr_valor_venda()) ;
            
            if ($this->getDt_cadastro()) 
                $sql .= " and dt_cadastro = " . $this->getDt_cadastro();
            
            $sql .= " order by 1 desc ";
            
            $res = $db->prepare($sql);
            $res->execute();
        } catch (\PDOException $e) {
            return false;
        }

        $obj = $res->setFetchMode(\PDO::FETCH_OBJ);
        $dados = $res->fetchAll();

        $arr = array();
        foreach ($dados as $obj) {
            $arr[] = $this->preencherObjeto($obj);
        }
        return $arr;
    }

    public function ler()
    {
        $db = Conexao::conecta();
        try {

            $sql = " select * 
                       from vendas.venda 
                      where id_venda = " . $this->getId_venda();

            $res = $db->prepare($sql);
            $res->execute();
        } catch (\PDOException $e) {
            return false;
        }

        $obj = $res->fetch(\PDO::FETCH_OBJ);

        return $this->preencherObjeto($obj);;
    }

    function preencherObjeto($obj)
    {
        $Venda = new Venda;
        $Venda->setId_venda(trim($obj->id_venda));
        $Venda->setNr_valor_venda(trim($obj->nr_valor_venda));
        $Venda->setDt_cadastro(trim($obj->dt_cadastro));
        return $Venda;
    }
}
