<?php

namespace App\Core;

class View
{
    private $layout = 'default';
    private $layouts = '../app/Views/layouts/';
    private $viewPath = '../app/Views/';

    public function render($view, $data = [])
    {
        return $this->renderLayout($this->renderView($view, $data));
    }

    private function renderLayout($content)
    {
        if (file_exists($this->layouts)) {
            ob_start();
            return include $this->layouts . $this->layout . '.php';
        }
    }


    private function renderView($view, $data)
    {
        extract($data);
        if (file_exists($this->viewPath)) {
            ob_start();
            include $this->viewPath . $view . '.php';
            return ob_get_clean();
        }
    }

    public function redirect($url)
    {
        header("Location: $url");
        exit;
    }
}