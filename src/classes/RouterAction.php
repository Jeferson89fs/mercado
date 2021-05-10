<?php

namespace Src\Classes;

use Exception;
use Src\Classes\Routes;

/**
 * Classe responsável para chamar o Controller/método 
 * correspondente a Url copm os parametros..
 */
class RouterAction extends Routes
{

    private $Method;
    private $Param = [];
    private $Obj;

    protected function getMethod() {return $this->Method;}
    private function setMethod($x){$this->Method = $x;}

    protected function getParam(){return $this->Param;}
    private function setParam($x){$this->Param = $x;}

    public function __construct()
    {
        self::addController();
    }

    #Método de adição do controller
    private function addController()
    {
        
        $RotaController = $this->getRoute();
        $NameClass = "App\\Controller\\{$RotaController}";
        $this->Obj = new $NameClass;
        //if (isset($this->parserUrl()[1])) {
            self::addMethod();
        //}
    }

    #Método de adição de método do controller
    private function addMethod()
    {
        $this->setMethod($this->parserUrl()[1] ? $this->parserUrl()[1] : 'index');
        
        if (!method_exists($this->Obj, $this->getMethod())) {
            echo "Método não existe";    
        }

        self::addParam();    

        call_user_func_array([$this->Obj, $this->getMethod()], $this->getParam());
    }
    
    #Método de adição de parâmetros do controller
    private function addParam()
    {
        $count = count($this->parserUrl());

        if($count > 2){ //existe parametros
            foreach($this->parserUrl() as $Key => $Value){
                if($Key > 1){
                    $this->setParam($this->Param += [$Key => $Value]);
                }
            }            
        }        
    }
}
