<?php

namespace App\Model;

use App\Controller\PercentualImpostoController;
use Exception;
use App\Model\Conexao;
use App\Model\Percentual_imposto;

class Tipo_produto
{

    private $id_tipo_produto;
    private $nm_tipo_produto;

    public $PercentualImposto;
    
    function __construct(){
        $this->PercentualImposto = new Percentual_imposto();
    }
    

    public function getId_tipo_produto()
    {
        return $this->id_tipo_produto;
    }

    public function getNm_tipo_produto()
    {
        return $this->nm_tipo_produto;
    }

    public function setId_tipo_produto($x)
    {
        $this->id_tipo_produto = $x;
    }

    public function setNm_tipo_produto($x)
    {
        $this->nm_tipo_produto = $x;
    }
    
    public function setPersentualImposto($obj)
    {
        $this->PercentualImposto = $obj;
    }

    public function getPercentualImposto(){
        if($this->getId_tipo_produto()){
            $this->PercentualImposto->setId_tipo_produto($this->getId_tipo_produto());    
            $this->PercentualImposto = $this->PercentualImposto->lerPorTipo();
        }

        return $this->PercentualImposto;
    }

    public function validaDados($acao = '')
    {
        $msg_erro = '';
        if ($acao == 'inserir'  || $acao == 'alterar') {
            if (!trim($this->getNm_tipo_produto())) {
                $msg_erro = 'Preencha o campo Tipo do Produto';
            }
        }

        if ($acao == 'insert' && trim($this->getNm_tipo_produto())) {
            $obj = new Tipo_produto;
            $obj->setNm_tipo_produto($this->getNm_tipo_produto());
            if (count($obj->listar()) > 0) {
                $msg_erro .= "<br /> - Já existe uma Tipo de Produto com esse nome!";
            }
        }

        if ($acao == 'deletar') {
            if (!$this->getId_tipo_produto()) {
                $msg_erro .= "<br /> - Informe o Id do Registro!";
            }
        }

        return $msg_erro;
    }

    public function inserir()
    {
        $db = Conexao::conecta();

        try {

            $sql = " insert into vendas.tipo_produto (id_tipo_produto,
                                             nm_tipo_produto 
                                            )values(
                                                nextval('vendas.tipo_produto_id_tipo_produto_seq'), 
                                                '" .  str_replace('\'', '',$this->getNm_tipo_produto()) . "') ";


            $res = $db->prepare($sql);
            $res->execute();
        } catch (\PDOException $e) {

            return false;
        }

        return true;
    }

    public function alterar()
    {
        $db = Conexao::conecta();

        try {

            $sql = " update vendas.tipo_produto             
                        set nm_tipo_produto = '" .  str_replace('\'', '',$this->getNm_tipo_produto()) . "' 
                      where id_tipo_produto = " . $this->getId_tipo_produto();
            echo $sql;
            $res = $db->prepare($sql);
            $res->execute();
        } catch (\PDOException $e) {

            return false;
        }

        return true;
    }

    public function deletar()
    {
        $db = Conexao::conecta();

        try {

            $sql = " delete from vendas.tipo_produto where id_tipo_produto = " . $this->getId_tipo_produto();
            $res = $db->prepare($sql);
            $res->execute();
        } catch (\PDOException $e) {
            return false;
        }

        return true;
    }

    public function listar()
    {
        $db = Conexao::conecta();

        try {

            $sql = " select * from vendas.tipo_produto tp                 
                      where 1=1 ";

            if ($this->getId_tipo_produto()) {
                $sql .= " and tp.id_tipo_produto = " . $this->getId_tipo_produto();
            }

            if ($this->getNm_tipo_produto()) {
                $sql .= " and upper(tp.nm_tipo_produto) like upper('%" . $this->getNm_tipo_produto() . "%')";
            }
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
                       from vendas.tipo_produto tp                       
                      where tp.id_tipo_produto = " . $this->getId_tipo_produto();

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
        $Tipo_produto = new Tipo_produto;
        $Tipo_produto->setId_tipo_produto(trim($obj->id_tipo_produto));
        $Tipo_produto->setNm_tipo_produto(trim($obj->nm_tipo_produto));
        
        return $Tipo_produto;

        
    }
}
