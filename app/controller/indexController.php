<?php

namespace App\Controller;

use Src\Classes\View;

use App\Model\Tipo_produto;
use App\Model\Produto;
use App\Model\Venda;

class IndexController
{
    function index()
    {

        $Tipo_produto = new Tipo_produto();
        $total_tipo_produto = count($Tipo_produto->listar());

        $Produto = new Produto();
        $total_produto = count($Produto->listar());

        $Venda = new Venda();
        $total_venda = count($Venda->listar());

        $this->arquivos[] = ROOT_PATH . "app/view/index/pesqIndex.php";
        $this->arquivos[] = ROOT_PATH . "app/view/index/jsIndex.php";
        View::render($this->arquivos,[ 'total_tipo_produto' => $total_tipo_produto, 'total_produto' => $total_produto, 'total_venda' => $total_venda, ]);
    }
}
