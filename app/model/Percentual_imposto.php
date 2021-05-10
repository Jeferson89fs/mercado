<?php

namespace App\Model;

use Exception;
use App\Model\Conexao;
use Src\Classes\Utils;
class Percentual_imposto
{

  private $id_percentual_imposto;
  private $id_tipo_produto;
  private $nr_valor_imposto;
  private $dt_cadastro;
  private $dt_desativacao;
  public $fl_situacao;
  
  public $Tipo_produto;

  public function __construct(){    
    $this->fl_situacao = array('A' => 'Ativo', 'I' => 'Inativo');
  }

  public function getId_percentual_imposto(){ return $this->id_percentual_imposto;}
  public function getId_tipo_produto(){ return $this->id_tipo_produto;}
  public function getNr_valor_imposto(){ return $this->nr_valor_imposto;}
  public function getDt_cadastro(){ return $this->dt_cadastro;}
  public function getDt_desativacao(){ return $this->dt_desativacao;}
  public function getSituacao(){ return trim($this->dt_desativacao) =='' ? $this->fl_situacao['A'] : $this->fl_situacao['I'];}
  
  public function getTipo_produto(){ 
    if($this->getId_tipo_produto()){
        $this->Tipo_produto = new Tipo_produto();
        $this->Tipo_produto->setId_tipo_produto($this->id_tipo_produto);    
        $this->Tipo_produto = $this->Tipo_produto->ler();
    }

    return $this->Tipo_produto;    
    }
 
  public function setId_percentual_imposto($x){ $this->id_percentual_imposto = $x;}
  public function setId_tipo_produto($x){ $this->id_tipo_produto = $x;}
  public function setNr_valor_imposto($x){ $this->nr_valor_imposto = $x;}
  public function setDt_cadastro($x){ $this->dt_cadastro = $x;}
  public function setDt_desativacao($x){ $this->dt_desativacao = $x;}
  
  public function setTipo_produto($obj){ $this->Tipo_produto = $obj;}
   
    public function validaDados($acao = '')
    {
        $msg_erro = '';
        if ($acao == 'inserir'  || $acao == 'alterar') {
            if (!trim($this->getId_tipo_produto())) {
                $msg_erro = 'Preencha o campo Tipo do Produto';
            }
            if (!trim($this->getNr_valor_imposto())) {
                $msg_erro = 'Preencha o campo Porcentagem do Imposto';
            }
        }

        if ($acao == 'deletar') {
            if (!$this->getId_percentual_imposto()) {
                $msg_erro .= "<br /> - Informe o Id do Registro!";
            }
        }

        return $msg_erro;
    }

    public function inserir()
    {
        $db = Conexao::conecta();

        try {

            $sql = " insert into vendas.percentual_imposto (id_percentual_imposto,
                                                            id_tipo_produto,
                                                            nr_valor_imposto,
                                                            dt_cadastro,
                                                            dt_desativacao )values(
                                                nextval('vendas.percentual_imposto_id_percentual_imposto_seq'), 
                                                " . $this->getId_tipo_produto() . ",
                                                " . Utils::formataValor($this->getNr_valor_imposto()) . ",
                                                now(),
                                                NULL) ";


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

            $sql = " update vendas.percentual_imposto             
                        set nr_valor_imposto = " . Utils::formataValor($this->getNr_valor_imposto()) . " 
                      where id_percentual_imposto = " . $this->getId_percentual_imposto();
            
            $res = $db->prepare($sql);
            $res->execute();
        } catch (\PDOException $e) {

            return false;
        }

        return true;
    }

    public function desativarImpostosAnteriores()
    {
        $db = Conexao::conecta();

        try {

            $sql = " update vendas.percentual_imposto             
                        set dt_desativacao = now()
                      where id_tipo_produto = " . $this->getId_tipo_produto();
            
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

            $sql = " delete from vendas.percentual_imposto where id_percentual_imposto = " . $this->getId_percentual_imposto();
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

            $sql = " select * from vendas.percentual_imposto pi
                 inner join vendas.tipo_produto tp on tp.id_tipo_produto = pi.id_tipo_produto
                     where 1=1 ";

            if ($this->getId_percentual_imposto()) {
                $sql .= " and pi.id_percentual_imposto = " . $this->getId_percentual_imposto();
            }

            if ($this->getId_tipo_produto()) {
                $sql .= " and pi.id_tipo_produto = " . $this->getId_tipo_produto();
            }

            if ($this->getNr_valor_imposto()) {
                $sql .= " and pi.nr_valor_imposto = " . $this->getNr_valor_imposto();
            }

            if ($this->getDt_cadastro()) {
                $sql .= " and pi.dt_cadastro = '" . $this->getDt_cadastro()."'";
            }

            if ($this->getDt_desativacao()) {
                $sql .= " and pi.dt_desativacao = '" . $this->getDt_desativacao()."'";
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
                       from vendas.percentual_imposto pi
                 inner join vendas.tipo_produto tp on tp.id_tipo_produto = pi.id_tipo_produto
                      where id_percentual_imposto = " . $this->getId_percentual_imposto();

            $res = $db->prepare($sql);
            $res->execute();
        } catch (\PDOException $e) {
            return false;
        }

        $obj = $res->fetch(\PDO::FETCH_OBJ);

        return $this->preencherObjeto($obj);;
    }
    
    public function lerPorTipo()
    {
        $db = Conexao::conecta();
        try {

            $sql = " select * 
                       from vendas.percentual_imposto pi                 
                      where dt_desativacao is null and id_tipo_produto = " . $this->getId_tipo_produto();

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
        $Percentual_imposto = new Percentual_imposto;
        $Percentual_imposto->setId_percentual_imposto(trim($obj->id_percentual_imposto));
        $Percentual_imposto->setId_tipo_produto(trim($obj->id_tipo_produto));
        $Percentual_imposto->setNr_valor_imposto(trim(Utils::mostraValor($obj->nr_valor_imposto)));
        $Percentual_imposto->setDt_cadastro(trim($obj->dt_cadastro));
        $Percentual_imposto->setDt_desativacao(trim($obj->dt_desativacao));
        
        return $Percentual_imposto;
    }
}
