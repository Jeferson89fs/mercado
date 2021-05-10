<?php

namespace App\Controller;

use Src\Classes\View;
use App\Model\Tipo_produto;

class TipoProdutoController
{
    
    private $arquivos;

    public function __construct()
    {    
         $this->arquivos= [];    
    }
    
    function index()
    {        

        $Tipo_produto = $this->loadObject($_REQUEST);        
        $arrTipo_produto = $Tipo_produto->listar();
        $this->arquivos[] = ROOT_PATH."app/view/tipo_produto/pesqTipo_produto.php";
        $this->arquivos[] = ROOT_PATH."app/view/tipo_produto/listTipo_produto.php";
        $this->arquivos[] = ROOT_PATH."app/view/tipo_produto/jsTipo_produto.php";
        View::render($this->arquivos, ['Tipo_produto' => $Tipo_produto, 'arrTipo_produto' => $arrTipo_produto]);
    }

    function novo()
    {    
        $Tipo_produto = $this->loadObject($_REQUEST);            
        $this->arquivos[] = ROOT_PATH."app/view/tipo_produto/formTipo_produto.php";        
        $this->arquivos[] = ROOT_PATH."app/view/tipo_produto/jsTipo_produto.php";
        View::render($this->arquivos, ['Tipo_produto' => $Tipo_produto]);
    }

    function edit($id_tipo_produto)
    {    
        $Tipo_produto = $this->loadObject($_REQUEST);            
        $Tipo_produto->setId_tipo_produto($id_tipo_produto);
        $Tipo_produto =$Tipo_produto->ler();

        $this->arquivos[] = ROOT_PATH."app/view/tipo_produto/formTipo_produto.php";        
        $this->arquivos[] = ROOT_PATH."app/view/tipo_produto/jsTipo_produto.php";
        View::render($this->arquivos, ['Tipo_produto' => $Tipo_produto]);
    }


    function insert()
    {        
        $Tipo_produto = $this->loadObject($_REQUEST);          
        $msg_erro = $Tipo_produto->validaDados('insert');
        
        if($msg_erro == ''){            
            if(!$Tipo_produto->inserir()){                
                $msg_erro .= "Erro ao inserir o registro!";
            }else{
                $msg_sucess = "Registro Inserido com sucesso!";
            }
        }
       
        if($msg_erro != ''){
            $Tipo_produto = $this->loadObject($_REQUEST);            
            $this->arquivos[] = ROOT_PATH."app/view/tipo_produto/formTipo_produto.php";        
            $this->arquivos[] = ROOT_PATH."app/view/tipo_produto/jsTipo_produto.php";        
            View::render($this->arquivos, ['Tipo_produto' => $Tipo_produto, 'msg_erro' => $msg_erro]);
            exit;            
        }

        $_SESSION['msg_success'] = $msg_sucess;
        header('location:'.HTTP_PATH.'tipo_produto');
    }

    function update()
    {        
        $Tipo_produto = $this->loadObject($_REQUEST);          
        $msg_erro = $Tipo_produto->validaDados('alterar');
        
        if($msg_erro == ''){            
            if(!$Tipo_produto->alterar()){                
                $msg_erro .= "Erro ao Alterar o registro!";
            }else{
                $msg_sucess = "Registro Alterado com sucesso!";
            }
        }
       
        if($msg_erro != ''){
            $Tipo_produto = $this->loadObject($_REQUEST);            
            $this->arquivos[] = ROOT_PATH."app/view/tipo_produto/formTipo_produto.php";        
            $this->arquivos[] = ROOT_PATH."app/view/tipo_produto/jsTipo_produto.php";        
            View::render($this->arquivos, ['Tipo_produto' => $Tipo_produto, 'msg_erro' => $msg_erro]);
            exit;            
        }

        $_SESSION['msg_success'] = $msg_sucess;
        header('location:'.HTTP_PATH.'tipo_produto');
    }

    function delete($id_tipo_produto)
    {        
        $Tipo_produto = $this->loadObject($_REQUEST);          
        $Tipo_produto->setId_tipo_produto($id_tipo_produto);
        $msg_erro = $Tipo_produto->validaDados('deletar');
        
        if($msg_erro == ''){            
            if(!$Tipo_produto->deletar()){                
                $msg_erro .= "Erro ao Deletar o registro!";
            }else{
                $msg_sucess = "Registro Deletado com sucesso!";
            }
        }
       
        if($msg_erro != ''){
            $Tipo_produto = $this->loadObject($_REQUEST);            
            $this->arquivos[] = ROOT_PATH."app/view/tipo_produto/formTipo_produto.php";        
            $this->arquivos[] = ROOT_PATH."app/view/tipo_produto/jsTipo_produto.php";        
            View::render($this->arquivos, ['Tipo_produto' => $Tipo_produto, 'msg_erro' => $msg_erro]);
            exit;            
        }

        $_SESSION['msg_success'] = $msg_sucess;
        header('location:'.HTTP_PATH.'tipo_produto');
    }

    private function loadObject($Request=''){
        $Tipo_produto = new Tipo_produto();
        $Tipo_produto->setId_tipo_produto($Request['id_tipo_produto']);
        $Tipo_produto->setNm_tipo_produto($Request['nm_tipo_produto']);
        return $Tipo_produto;
    }
}
