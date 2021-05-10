<?php

namespace App\Controller;

use Src\Classes\View;
use App\Model\Tipo_produto;
use App\Model\Percentual_imposto;

class PercentualImpostoController
{    
    private $arquivos;

    public function __construct()
    {    
         $this->arquivos= [];    
    }
    
    function index($id_tipo_produto)
    {   
        $Tipo_produto = new Tipo_produto;        
        $Tipo_produto->setId_tipo_produto($id_tipo_produto);
        $Tipo_produto = $Tipo_produto->ler();

        $Percentual_imposto = $this->loadObject($_REQUEST);
        $Percentual_imposto->setId_tipo_produto($id_tipo_produto);
        $arrPercentual_imposto = $Percentual_imposto->listar();
        
        $this->arquivos[] = ROOT_PATH."app/view/percentual_imposto/pesqPercentual_imposto.php";        
        $this->arquivos[] = ROOT_PATH."app/view/percentual_imposto/listPercentual_imposto.php";        
        $this->arquivos[] = ROOT_PATH."app/view/percentual_imposto/jsPercentual_imposto.php";
        View::render($this->arquivos, ['Tipo_produto' => $Tipo_produto, 'Percentual_imposto' => $Percentual_imposto, 'arrPercentual_imposto' => $arrPercentual_imposto]);
    }

    function novo($id_tipo_produto)
    {    

        $Tipo_produto = new Tipo_produto;        
        $Tipo_produto->setId_tipo_produto($id_tipo_produto);
        $Tipo_produto = $Tipo_produto->ler();

        $Percentual_imposto = $this->loadObject($_REQUEST);
        $Percentual_imposto->setId_tipo_produto($id_tipo_produto);

        $this->arquivos[] = ROOT_PATH."app/view/percentual_imposto/formPercentual_imposto.php";        
        $this->arquivos[] = ROOT_PATH."app/view/percentual_imposto/jsPercentual_imposto.php";
        View::render($this->arquivos, ['Tipo_produto' => $Tipo_produto,'Percentual_imposto' => $Percentual_imposto]);
    }

    function edit($id_tipo_produto,$id_percentual_imposto)
    {    
        $Tipo_produto = new Tipo_produto;
        $Tipo_produto->setId_tipo_produto($id_tipo_produto);
        $Tipo_produto =$Tipo_produto->ler();

        $Percentual_imposto = $this->loadObject($_REQUEST);
        $Percentual_imposto->setId_tipo_produto($id_tipo_produto);
        $Percentual_imposto->setId_percentual_imposto($id_percentual_imposto);
        $Percentual_imposto = $Percentual_imposto->ler();
        
        $this->arquivos[] = ROOT_PATH."app/view/percentual_imposto/formPercentual_imposto.php";        
        $this->arquivos[] = ROOT_PATH."app/view/percentual_imposto/jsPercentual_imposto.php";
        View::render($this->arquivos, ['Tipo_produto' => $Tipo_produto,'Percentual_imposto' => $Percentual_imposto]);
    }


    function insert($id_tipo_produto)
    {          
        
        $Tipo_produto = new Tipo_produto;
        $Tipo_produto->setId_tipo_produto($id_tipo_produto);
        $Tipo_produto =$Tipo_produto->ler();
        
        $Percentual_imposto = $this->loadObject($_REQUEST);
        $Percentual_imposto->setId_tipo_produto($id_tipo_produto);
        
        $msg_erro = $Percentual_imposto->validaDados('insert');
        
        if($msg_erro == ''){            

            $Percentual_imposto_desativacao = $this->loadObject($_REQUEST);
            $Percentual_imposto_desativacao->setId_tipo_produto($id_tipo_produto);
            $Percentual_imposto_desativacao->desativarImpostosAnteriores();

            if(!$Percentual_imposto->inserir()){                
                $msg_erro .= "Erro ao inserir o registro!";
            }else{
                $msg_sucess = "Registro Inserido com sucesso!";
            }
        }


        if($msg_erro != ''){            
            $Percentual_imposto = $this->loadObject($_REQUEST);
            $Percentual_imposto->setId_tipo_produto($id_tipo_produto);
            $this->arquivos[] = ROOT_PATH."app/view/percentual_imposto/formPercentual_imposto.php";        
            $this->arquivos[] = ROOT_PATH."app/view/percentual_imposto/jsPercentual_imposto.php";        
            View::render($this->arquivos, ['Tipo_produto' => $Tipo_produto, 'msg_erro' => $msg_erro,'Percentual_imposto' => $Percentual_imposto]);
            exit;            
        }

        $_SESSION['msg_success'] = $msg_sucess;        
        header('location:'.HTTP_PATH.'percentual_imposto/index/'.$Tipo_produto->getId_tipo_produto());
    }

    function update($id_tipo_produto,$id_percentual_imposto)
    {        
        $Tipo_produto = $this->loadObject($_REQUEST);            
        $Tipo_produto->setId_tipo_produto($id_tipo_produto);
        $Tipo_produto =$Tipo_produto->ler();
        
        $Percentual_imposto = $this->loadObject($_REQUEST);
        $Percentual_imposto->setId_tipo_produto($id_tipo_produto);
        $Percentual_imposto->setId_percentual_imposto($id_percentual_imposto);
        
        $msg_erro = $Percentual_imposto->validaDados('alterar');
        
        if($msg_erro == ''){            
            if(!$Percentual_imposto->alterar()){                
                $msg_erro .= "Erro ao Alterar o registro!";
            }else{
                $msg_sucess = "Registro Alterado com sucesso!";
            }
        }
       
        if($msg_erro != ''){
            $Percentual_imposto = $this->loadObject($_REQUEST);
            $Percentual_imposto->setId_tipo_produto($id_tipo_produto);
            $Percentual_imposto->setId_percentual_imposto($id_percentual_imposto);
            $Percentual_imposto->setId_percentual_imposto($id_percentual_imposto);
    
            $this->arquivos[] = ROOT_PATH."app/view/percentual_imposto/formPercentual_imposto.php";        
            $this->arquivos[] = ROOT_PATH."app/view/percentual_imposto/jsPercentual_imposto.php";        
            View::render($this->arquivos, ['Tipo_produto' => $Tipo_produto, 'msg_erro' => $msg_erro, 'Percentual_imposto' => $Percentual_imposto]);
            exit;            
        }

        $_SESSION['msg_success'] = $msg_sucess;
        header('location:'.HTTP_PATH.'percentual_imposto/index/'.$Tipo_produto->getId_tipo_produto());
    }

    function delete($id_tipo_produto,$id_percentual_imposto)
    {        
        $Percentual_imposto = $this->loadObject($_REQUEST);
        $Percentual_imposto->setId_tipo_produto($id_tipo_produto);
        $Percentual_imposto->setId_percentual_imposto($id_percentual_imposto);
        $msg_erro = $Percentual_imposto->validaDados('deletar');
        
        if($msg_erro == ''){            
            if(!$Percentual_imposto->deletar()){                
                $msg_erro .= "Erro ao Deletar o registro!";
            }else{
                $msg_sucess = "Registro Deletado com sucesso!";
            }
        }
       
        if($msg_erro != ''){
            $Tipo_produto = $this->loadObject($_REQUEST);            
            $this->arquivos[] = ROOT_PATH."app/view/percentual_imposto/formPercentual_imposto.php";        
            $this->arquivos[] = ROOT_PATH."app/view/percentual_imposto/jsPercentual_imposto.php";        
            View::render($this->arquivos, ['Tipo_produto' => $Tipo_produto, 'msg_erro' => $msg_erro]);
            exit;            
        }

        $_SESSION['msg_success'] = $msg_sucess;
        header('location:'.HTTP_PATH.'percentual_imposto/index/'.$id_tipo_produto);
    }

    private function loadObject($Request=''){
        $Percentual_imposto = new Percentual_imposto();
        $Percentual_imposto->setId_percentual_imposto($Request['id_percentual_imposto']);
        $Percentual_imposto->setId_tipo_produto($Request['id_tipo_produto']);
        $Percentual_imposto->setNr_valor_imposto($Request['nr_valor_imposto']);
        $Percentual_imposto->setDt_cadastro($Request['dt_cadastro']);
        $Percentual_imposto->setDt_desativacao($Request['dt_desativacao']);
        return $Percentual_imposto;
    }
}
