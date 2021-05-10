<?php
namespace App\Model;
use Src\Classes\Utils;
use App\Model\Produto;

Class Venda_item{
    private $id_venda_item;
    private $id_venda;
    private $id_produto;
    private $nr_valor;
    private $nr_quantidade;
    private $dt_cadastro;

    public $Produto;

    function __construct(){
        $this->Produto = new Produto();
    }

    public function getId_venda_item(){ return $this->id_venda_item;}
    public function getId_venda(){ return $this->id_venda;}
    public function getId_produto(){ return $this->id_produto;}
    public function getNr_valor(){ return $this->nr_valor;}
    public function getNr_quantidade(){ return $this->nr_quantidade;}
    public function getDt_cadastro(){ return $this->dt_cadastro;}
    
    public function getProduto(){
        if($this->getId_produto()){
            $this->Produto->setId_produto($this->getId_produto());
            $this->Produto = $this->Produto->ler();
        }

        return $this->Produto;
    }
    
    public function setId_venda_item($x){ $this->id_venda_item = $x;}    
    public function setId_venda($x){ $this->id_venda = $x;}
    public function setId_produto($x){ $this->id_produto = $x;}
    public function setNr_valor($x){ $this->nr_valor = $x;}
    public function setNr_quantidade($x){ $this->nr_quantidade = $x;}
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

            $sql = " insert into vendas.venda_item (id_venda_item,
                                                    id_venda,
                                                    id_produto ,
                                                    nr_valor,
                                                    nr_quantidade,
                                                    dt_cadastro                                                    
                                                    )values(
                                                        nextval('vendas.venda_item_id_venda_item_seq'), 
                                                        " . $this->getId_venda() . ",
                                                        " . $this->getId_produto() . ",
                                                        " . Utils::formataValor($this->getNr_valor()) . ",
                                                        " . Utils::formataValor($this->getNr_quantidade()) . ",
                                                        now()) ";
                                                        
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

            $sql = " select * from vendas.venda_item where 1=1 ";

            if ($this->getId_venda_item()) 
                $sql .= " and id_venda_item = " . $this->getId_venda_item();
            if ($this->getId_venda()) 
                $sql .= " and id_venda = " . $this->getId_venda();            
            if ($this->getId_produto()) 
                $sql .= " and id_produto = " . $this->getId_produto();
            if ($this->getNr_valor()) 
                $sql .= " and nr_valor = " . $this->getNr_valor();
            if ($this->getNr_quantidade()) 
                $sql .= " and nr_quantidade = " . $this->getNr_quantidade();
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
                       from vendas.venda_item
                      where id_venda_item = " . $this->getId_venda_item();

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
        $Venda_item = new Venda_item;
        $Venda_item->setId_venda_item($obj->id_venda_item);
        $Venda_item->setId_venda($obj->id_venda );
        $Venda_item->setId_produto($obj->id_produto );
        $Venda_item->setNr_valor(Utils::mostraValor($obj->nr_valor));
        $Venda_item->setNr_quantidade(Utils::mostraValor($obj->nr_quantidade));
        $Venda_item->setDt_cadastro($obj->dt_cadastro);
        
        return $Venda_item;
    }
}