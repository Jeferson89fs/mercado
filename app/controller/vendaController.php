<?php

namespace App\Controller;

use Src\Classes\View;
use App\Model\Tipo_produto;
use App\Model\Venda;
use App\Model\Venda_item;
use App\Model\Conexao;
use PDOException;

class VendaController
{

    function index()
    {
        $Tipo_produto = new Tipo_produto();
        $Venda = $this->loadObject($_REQUEST);
        $arrTipo_produto = $Tipo_produto->listar();

        $arrVenda = $Venda->listar();
        
        $this->arquivos[] = ROOT_PATH . "app/view/venda/pesqVenda.php";
        $this->arquivos[] = ROOT_PATH . "app/view/venda/listVenda.php";
        $this->arquivos[] = ROOT_PATH . "app/view/venda/jsVenda.php";
        View::render($this->arquivos, ['Venda' => $Venda, 'arrTipo_produto' => $arrTipo_produto, 'arrVenda' => $arrVenda]);
    }

    function novo()
    {    
        $Tipo_produto = new Tipo_produto();
        $Venda = $this->loadObject($_REQUEST);
        $arrTipo_produto = $Tipo_produto->listar();

        $this->arquivos[] = ROOT_PATH."app/view/venda/formVenda.php";                
        $this->arquivos[] = ROOT_PATH."app/view/venda/jsVenda.php";                
        View::render($this->arquivos, ['Tipo_produto' => $Tipo_produto, 'Venda' => $Venda]);
    }

    private function getValor_total_venda($Request){
        $total_produtos = count($_REQUEST['id_produto']);
        $valor_total = 0;
        for($i=0; $i < $total_produtos; $i++){
            $VendaItem = new Venda_item();            
            $valor_total += $_REQUEST['valor_total'][$i];            
        }

        return $valor_total;
    }

    public function finalizar_venda(){
        $json = array();
        $json['error']        = false;
        $json['seccess']      = false;
        $json['msg_retorno']  = '';

        if($_REQUEST['id_produto']){
            $total_produtos = count($_REQUEST['id_produto']);

            $db = Conexao::conecta();
            $db->beginTransaction();

            try{
                $Venda = new Venda();
                $Venda->setNr_valor_venda($this->getValor_total_venda($_REQUEST));
                $id_venda = $Venda->inserir();
            for($i=0; $i < $total_produtos; $i++){
                $VendaItem = new Venda_item();
                $VendaItem->setId_venda($id_venda);
                $VendaItem->setId_produto($_REQUEST['id_produto'][$i]);
                $VendaItem->setNr_quantidade($_REQUEST['nr_quantidade'][$i]);
                $VendaItem->setNr_valor($_REQUEST['valor_total'][$i]);                
                $VendaItem->inserir();
            }

            }catch(PDOException $e){
                $db->rollback();
                $json['error'] = true;
                $json['msg_retorno']  = 'Erro Ao inserir a venda!';

            }

            $db->commit();           
            $json['msg_retorno']  = 'Venda realizada com sucesso!';
            $json['seccess']      = true;
            echo json_encode($json);
            exit;
        }

        $json['msg_retorno']  = 'Adicione pelo menos um Item na lista!';
        echo json_encode($json);
        exit;
    }

    private function loadObject($Request=''){
        $Venda = new Venda();
        $Venda->setId_venda($Request['id_venda']);
        $Venda->setNr_valor_venda($Request['nr_valor_venda']);
        $Venda->setDt_cadastro($Request['dt_cadastro']);   
    
        return $Venda;
    }
}
