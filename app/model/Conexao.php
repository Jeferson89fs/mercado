<?php

namespace App\Model;

use PDOException;

class Conexao
{

    private static $conexaoBD;

    public static function conecta()
    {
        if (!isset(self::$conexaoBD)) {
            
            try {
                $db = new \PDO("pgsql:host=" . HOST . " port=" . PORT . "; dbname=" . BDNAME . " user=" . USER . " password=" . PASSWORD);
                $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                $db->setAttribute(\PDO::ATTR_CASE, \PDO::CASE_LOWER);
                self::$conexaoBD = $db;
            } catch (PDOException $e) {
                 echo "Erro ao Conectar o Banco de dados! ".$e->getMessage();
                 exit;
            }
        }
        
        return self::$conexaoBD;
    }
}
