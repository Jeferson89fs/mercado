<?php

namespace Src\Classes;

use Exception;
use Src\Traits\TraitUrlParser;

class Routes
{

    use TraitUrlParser;

    private $Rota;

    /**
     * Retorno da Rota
     */
    public function getRoute()
    {
        $Url = $this->parserUrl();

        //primeito parâmetro é sempre o controller responsável a ser passado
        $controller = $Url[0];

        /**
         * Rotas Disponíveis
         */
        $this->Rota = array(
            //URL                //Controller
            ""                   => "indexController",
            "index.php"          => "indexController",
            "tipo_produto"       => "tipoProdutoController",
            "percentual_imposto" => "percentualImpostoController",
            "produto"            => "produtoController",
            "venda"              => "vendaController",
            "venda_item"         => "venda_itemController"
        );

        if (!array_key_exists($controller, $this->Rota)) {
            return "Controller404";
        }

        if (file_exists(ROOT_PATH."app/controller/{$this->Rota[$controller]}.php")) {
            return $this->Rota[$controller];
        } else {            
            throw new Exception("Controller não encontrado!");
        }

        return false;
    }
}
