<?php
session_start();
header("Contenct-Type: text/html; charset-utf-8");

require_once(ROOT_PATH."src/vendor/autoload.php");

use Src\Classes\Routes;
use Src\Classes\RouterAction;
use App\Model\Conexao;

try{
  $RouterAction = new RouterAction();
  
}catch(Exception $error){      
    echo $error->getMessage();
}


