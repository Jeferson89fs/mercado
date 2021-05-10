<?php

/**
 * Diretório inicial do projeto
 */

$Diretorio = "";

define("HTTP_PATH","http://{$_SERVER['HTTP_HOST']}{$Diretorio}/");

$DIR = "";
if($Diretorio){
    $DIR = (substr($_SERVER['DOCUMENT_ROOT'], -1) == '/') ? $_SERVER['DOCUMENT_ROOT'] : $_SERVER['DOCUMENT_ROOT']."/" ;    
}


if($Diretorio){
    define("ROOT_PATH","{$DIR}{$Diretorio}/");
}else{
    define("ROOT_PATH","{$DIR}");
} 


define("HTTP_PATH_JS", HTTP_PATH."public/js/");
define("HTTP_PATH_CSS",HTTP_PATH."public/css/");
define("HTTP_PATH_IMG",HTTP_PATH."public/img/");

define("HOST","localhost");
define("PORT","5432");
define("BDNAME","postgres");
define("USER","postgres");
define("PASSWORD","1010");


