<?php
namespace Src\Traits;

trait TraitUrlParser
{
    public function parserUrl()
    {
        return explode('/', substr(rtrim($_SERVER['REQUEST_URI']) , 1), FILTER_SANITIZE_URL);
    }
}