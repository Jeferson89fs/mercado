<?php

namespace Src\Classes;

 class View{

    public static function render(array $arquivos, array $Param=null){
        
        foreach($Param as $c => $v){
            ${$c} =  $v;
        }

        if(file_exists(ROOT_PATH.'app/view/layout/header.php')){
            require_once( ROOT_PATH.'app/view/layout/header.php');
        }

        if(file_exists(ROOT_PATH.'app/view/layout/menu_lateral.php')){
            require_once( ROOT_PATH.'app/view/layout/menu_lateral.php');
        }
        
        
        foreach($arquivos as $arquivo){
            if(file_exists($arquivo)){
                require_once( $arquivo );
            }else{
                echo "arquivo não encontrado ( {$arquivo} )";
            }
        }        

        if(file_exists(ROOT_PATH.'app/view/layout/footer.php')){
            require_once( ROOT_PATH.'app/view/layout/footer.php');
        }
    }

}