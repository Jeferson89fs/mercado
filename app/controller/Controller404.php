<?php

namespace App\Controller;
use Src\Classes\View;

class Controller404{

    public function __construct()
    {    
        $arquivos = [];    
    }

    public function index($x='', $x2='', $x3=''){                    
        $arquivos[] = ROOT_PATH."app/view/layout/404.php";
        View::render($arquivos);
    }
    
}