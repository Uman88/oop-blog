<?php

namespace App\Core;

class Controller
{
    protected $true = true;

    protected function render($view, $data = [])
    {
        return (new View())->render($view, $data);
    }

    protected function redirect($url)
    {
        return (new View())->redirect($url);
    }
}