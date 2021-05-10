<?php

namespace App\Controller;

use Src\Classes\View;
use App\Model\Tipo_produto;
use App\Model\Produto;

class ProdutoController
{

    private $arquivos;

    public function __construct()
    {
        $this->arquivos = [];
    }

    function index()
    {
        $Tipo_produto = new Tipo_produto();
        $arrTipo_produto = $Tipo_produto->listar();

        $Produto = $this->loadObject($_REQUEST);
        $arrProduto = $Produto->listar();
        $this->arquivos[] = ROOT_PATH . "app/view/produto/pesqProduto.php";
        $this->arquivos[] = ROOT_PATH . "app/view/produto/listProduto.php";
        $this->arquivos[] = ROOT_PATH . "app/view/produto/jsProduto.php";
        View::render($this->arquivos, ['Produto' => $Produto, 'arrProduto' => $arrProduto, 'arrTipo_produto' => $arrTipo_produto]);
    }
    
    function modal()
    {
        $Tipo_produto = new Tipo_produto();
        $arrTipo_produto = $Tipo_produto->listar();

        $Produto = $this->loadObject($_REQUEST);
        $arrProduto = $Produto->listar();
        $this->arquivos[] = ROOT_PATH . "app/view/produto/pesqProduto.php";
        $this->arquivos[] = ROOT_PATH . "app/view/produto/listProduto.php";
        $this->arquivos[] = ROOT_PATH . "app/view/produto/jsProduto.php";
        View::render($this->arquivos, ['Produto' => $Produto, 'arrProduto' => $arrProduto, 'arrTipo_produto' => $arrTipo_produto]);
    }

    function novo()
    {
        $Tipo_produto = new Tipo_produto();
        $arrTipo_produto = $Tipo_produto->listar();

        $Produto = $this->loadObject($_REQUEST);
        $this->arquivos[] = ROOT_PATH . "app/view/produto/formProduto.php";
        $this->arquivos[] = ROOT_PATH . "app/view/produto/jsProduto.php";
        View::render($this->arquivos, ['Produto' => $Produto, 'arrTipo_produto' => $arrTipo_produto]);
    }

    function edit($id_produto)
    {
        $Tipo_produto = new Tipo_produto();
        $arrTipo_produto = $Tipo_produto->listar();

        $Produto = $this->loadObject($_REQUEST);
        $Produto->setId_produto($id_produto);
        $Produto = $Produto->ler();

        $this->arquivos[] = ROOT_PATH . "app/view/produto/formProduto.php";
        $this->arquivos[] = ROOT_PATH . "app/view/produto/jsProduto.php";
        View::render($this->arquivos, ['Produto' => $Produto, 'arrTipo_produto' => $arrTipo_produto]);
    }


    function insert()
    {
        $Produto = $this->loadObject($_REQUEST);
        $msg_erro = $Produto->validaDados('insert');

        if ($msg_erro == '') {
            if (!$Produto->inserir()) {
                $msg_erro .= "Erro ao inserir o registro!";
            } else {
                $msg_sucess = "Registro Inserido com sucesso!";
            }
        }

        if ($msg_erro != '') {
            $Tipo_produto = new Tipo_produto();
            $arrTipo_produto = $Tipo_produto->listar();
            
            $Produto = $this->loadObject($_REQUEST);
            $this->arquivos[] = ROOT_PATH . "app/view/produto/formProduto.php";
            $this->arquivos[] = ROOT_PATH . "app/view/produto/jsProduto.php";
            View::render($this->arquivos, ['Produto' => $Produto, 'msg_erro' => $msg_erro, 'arrTipo_produto' => $arrTipo_produto]);
            
        }

        $_SESSION['msg_success'] = $msg_sucess;
        header('location:' . HTTP_PATH . 'produto');
    }

    function update()
    {
        $Produto = $this->loadObject($_REQUEST);      
        $msg_erro = $Produto->validaDados('alterar');
        

        if ($msg_erro == '') {
            if (!$Produto->alterar()) {
                $msg_erro .= "Erro ao Alterar o registro!";
            } else {
                $msg_sucess = "Registro Alterado com sucesso!";
            }
        }

        if ($msg_erro != '') {
            $Tipo_produto = new Tipo_produto();
            $arrTipo_produto = $Tipo_produto->listar();

            $Produto = $this->loadObject($_REQUEST);
            $this->arquivos[] = ROOT_PATH . "app/view/produto/formProduto.php";
            $this->arquivos[] = ROOT_PATH . "app/view/produto/jsProduto.php";
            View::render($this->arquivos, ['Produto' => $Produto, 'msg_erro' => $msg_erro, 'arrTipo_produto' => $arrTipo_produto]);
            exit;
        }

        $_SESSION['msg_success'] = $msg_sucess;
        header('location:' . HTTP_PATH . 'produto');
    }

    function delete($id_produto)
    {
        $Produto = $this->loadObject($_REQUEST);
        $Produto->setId_produto($id_produto);
        $msg_erro = $Produto->validaDados('deletar');

        if ($msg_erro == '') {
            if (!$Produto->deletar()) {
                $msg_erro .= "Erro ao Deletar o registro!";
            } else {
                $msg_sucess = "Registro Deletado com sucesso!";
            }
        }

        if ($msg_erro != '') {
            $Tipo_produto = new Tipo_produto();
            $arrTipo_produto = $Tipo_produto->listar();

            $Produto = $this->loadObject($_REQUEST);
            $this->arquivos[] = ROOT_PATH . "app/view/produto/formProduto.php";
            $this->arquivos[] = ROOT_PATH . "app/view/produto/jsProduto.php";
            View::render($this->arquivos, ['Produto' => $Produto, 'msg_erro' => $msg_erro, 'arrTipo_produto' => $arrTipo_produto]);
            exit;
        }

        $_SESSION['msg_success'] = $msg_sucess;
        header('location:' . HTTP_PATH . 'produto');
    }

    private function loadObject($Request = '')
    {
        $Produto = new Produto();
        $Produto->setId_produto($Request['id_produto']);
        $Produto->setId_tipo_produto($Request['id_tipo_produto']);
        $Produto->setCd_produto($Request['cd_produto']);
        $Produto->setNm_produto($Request['nm_produto']);
        $Produto->setNr_valor($Request['nr_valor']);
        $Produto->setDs_produto($Request['ds_produto']);
        $Produto->setFl_ativo($Request['fl_ativo']);
        $Produto->setDt_cadastro($Request['dt_cadastro']);
        return $Produto;
    }

    function search_produto_codigo($cd_produto){  
          
        $Produto = new Produto();        
        $Produto->setCd_produto($cd_produto);        
        $arr = $Produto->listar();

        if(!$arr){
            $json=[];
            $json['error']      = true;
            $json['msg_error']  = 'Nenhum Produto encontrado!';
            echo json_encode($json);
            exit;
        }
        
        $Produto = $arr[0];

        $json=[];
        $json['id_produto'] = $Produto->getId_produto();
        $json['cd_produto'] = $Produto->getCd_produto();
        $json['nm_produto'] = $Produto->getNm_produto();
        $json['nr_valor']  = $Produto->getNr_valor();
        $json['id_tipo_produto'] = $Produto->getId_tipo_produto();
        $json['nm_tipo_produto'] = $Produto->getTipo_produto()->getNm_tipo_produto();
        $json['nr_valor_imposto'] = $Produto->getTipo_produto()->getPercentualImposto()->getNr_valor_imposto();

        echo json_encode($json);
        exit;
    }
}
