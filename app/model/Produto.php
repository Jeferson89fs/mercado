<?php

namespace App\Model;

use Exception;
use App\Model\Conexao;
use Src\Classes\Utils;

class Produto
{
    private $id_produto;
    private $id_tipo_produto;
    private $cd_produto;
    private $nm_produto;
    private $nr_valor;
    private $ds_produto;
    private $fl_ativo;
    private $dt_cadastro;
    private $Tipo_produto;

    function __construct()
    {
        $this->Tipo_produto = new Tipo_produto();
    }

    public function getId_produto()
    {
        return $this->id_produto;
    }
    public function getId_tipo_produto()
    {
        return $this->id_tipo_produto;
    }
    public function getCd_produto()
    {
        return $this->cd_produto;
    }
    public function getNm_produto()
    {
        return $this->nm_produto;
    }
    public function getNr_valor()
    {
        return $this->nr_valor;
    }
    public function getDs_produto()
    {
        return $this->ds_produto;
    }
    public function getFl_ativo()
    {
        return $this->fl_ativo;
    }
    public function getDt_cadastro()
    {
        return $this->dt_cadastro;
    }
    public function getTipo_produto()
    {
        if ($this->getId_tipo_produto()) {
            $this->Tipo_produto->setId_tipo_produto($this->id_tipo_produto);
            $this->Tipo_produto = $this->Tipo_produto->ler();
        }

        return $this->Tipo_produto;
    }

    public function setId_produto($x)
    {
        $this->id_produto = $x;
    }
    public function setId_tipo_produto($x)
    {
        $this->id_tipo_produto = trim($x);
    }
    public function setCd_produto($x)
    {
        $this->cd_produto = trim($x);
    }
    public function setNm_produto($x)
    {
        $this->nm_produto = trim($x);
    }
    public function setNr_valor($x)
    {
        $this->nr_valor = trim($x);
    }
    public function setDs_produto($x)
    {
        $this->ds_produto = $x;
    }
    public function setFl_ativo($x)
    {
        $this->fl_ativo = trim($x);
    }
    public function setDt_cadastro($x)
    {
        $this->dt_cadastro = trim($x);
    }

    public function setTipo_produto(object $obj)
    {
        $this->Tipo_produto = $obj;
    }

    public function validaDados($acao = '')
    {
        $msg_erro = '';
        if ($acao == 'inserir'  || $acao == 'alterar') {
            if (!trim($this->getId_tipo_produto())) {
                $msg_erro = 'Preencha o campo Tipo do Produto';
            }
            if (!trim($this->getCd_produto())) {
                $msg_erro = 'Preencha o campo Código do Produto';
            }
            if (!trim($this->getNm_produto())) {
                $msg_erro = 'Preencha o campo Nome do Produto';
            }
            if (!trim($this->getNr_valor())) {
                $msg_erro = 'Preencha o campo Valor do Produto';
            }
        }

        if ($acao == 'insert' && trim($this->getId_produto())) {
            $obj = new Produto;
            $obj->setCd_produto($this->getCd_produto());
            if (count($obj->listar()) > 0) {
                $msg_erro .= "<br /> - Já existe um Produto com esse código!";
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

            $ds_produto = $this->getDs_produto() ? "'" . $this->getDs_produto() . "'" : "NULL";

            $sql = " insert into vendas.produto (id_produto,
                                                 id_tipo_produto,
                                                 cd_produto,
                                                 nm_produto,
                                                 nr_valor,
                                                 ds_produto,
                                                 fl_ativo,
                                                 dt_cadastro)values(
                                                nextval('vendas.produto_id_produto_seq'), 
                                                '" . $this->getId_tipo_produto() . "',
                                                '" . $this->getCd_produto() . "',
                                                '" . str_replace('\'', '',$this->getNm_produto())  . "',
                                                '" . Utils::formataValor($this->getNr_valor()) . "',
                                                " . $ds_produto . ",
                                                'A',
                                                'now()' ) ";

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

            $sql = " update vendas.produto             
                        set nm_produto = '" . $this->getNm_produto() . "' ,
                        nr_valor = " . Utils::formataValor($this->getNr_valor()) . " ,
                        id_tipo_produto = " . $this->getId_tipo_produto() . " ,
                        ds_produto = '" . $this->getDs_produto() . "',
                        cd_produto = '" . $this->getCd_produto() . "',
                        fl_ativo = '" . $this->getFl_ativo() . "'
                      where id_produto = " . $this->getId_produto();
        
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

            $sql = " delete from vendas.produto where id_produto = " . $this->getId_produto();
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

            $sql = " select * from vendas.produto  p                  
                       where 1=1 ";

            if ($this->getId_produto())
                $sql .= " and p.id_produto = " . $this->getId_produto();

            if ($this->getCd_produto())
                $sql .= " and p.cd_produto = '" . $this->getCd_produto() . "'";

            if ($this->getNm_produto())
                $sql .= " and upper(p.nm_produto) like upper('%" . $this->getNm_produto() . "%')";

            if ($this->getDs_produto())
                $sql .= " and upper(p.ds_produto) like upper('%" . $this->getDs_produto() . "%')";

            if ($this->getFl_ativo())
                $sql .= " and p.fl_ativo = " . $this->getFl_ativo();

            if ($this->getDt_cadastro())
                $sql .= " and p.dt_cadastro = " . $this->getDt_cadastro();

            if ($this->getId_tipo_produto())
                $sql .= " and p.id_tipo_produto = " . $this->getId_tipo_produto();

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
                       from vendas.produto 
                      where id_produto = " . $this->getId_produto();

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
        $Produto = new Produto;
        $Produto->setId_produto($obj->id_produto);
        $Produto->setId_tipo_produto($obj->id_tipo_produto);
        $Produto->setCd_produto($obj->cd_produto);
        $Produto->setNm_produto($obj->nm_produto);
        $Produto->setNr_valor(Utils::mostraValor($obj->nr_valor, 2));
        $Produto->setDs_produto($obj->ds_produto);
        $Produto->setFl_ativo($obj->fl_ativo);
        $Produto->setDt_cadastro($obj->dt_cadastro);

        return $Produto;
    }
}
