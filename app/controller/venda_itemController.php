<?php

namespace App\Controller;

use Src\Classes\View;
use App\Model\Tipo_produto;
use App\Model\Venda;
use App\Model\Venda_item;

class Venda_itemController
{

    function index($id_venda)
    {

        $Venda = new Venda(); 
        $Venda->setId_venda($id_venda);
        $Venda = $Venda->ler();

        $Venda_item = new Venda_item(); 
        $Venda_item->setId_venda($id_venda);
        $arrVenda_item = $Venda_item->listar();

        $this->arquivos[] = ROOT_PATH . "app/view/venda_item/listVenda_item.php";        
        View::render($this->arquivos, ['Venda' => $Venda,  'arrVenda_item' => $arrVenda_item]);
    }
}
