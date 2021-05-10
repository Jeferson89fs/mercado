<?php

namespace Src\Classes;

class Utils
{

    public static function formataValor($valor)
    {
        if (!$valor)
            $valor = 0;

        if ((strstr($valor, ".")) && (!strstr($valor, ","))) return $valor;

        $valor = str_replace('.', '', $valor);
        $valor = str_replace(',', '.', $valor);
        return $valor;
    }

    static function mostraValor($valor, $casas_decimais = '')
    {
        if (!$valor)
            $valor = 0;
        if (trim($casas_decimais) === '') {
            $casas_decimais = 2;
        }

        $valor = str_replace(',', '.', $valor);
        $valor = number_format($valor, $casas_decimais, ',', '.');
        return $valor;
    }
}
