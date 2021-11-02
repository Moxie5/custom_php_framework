<?php

namespace App\Core;

use App\Core\Session;

class View
{
    public $layout = 'Default';

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function render($view, $data = array())
    {
        extract($data);
        $views = explode('/', $view);
        foreach ($views as $view) {
            $upview[] = ucfirst($view);
            $view = implode('/', $upview);
        }
        $path = APPPATH . 'Views/' . $view . '.php';
        // $path = APPPATH . 'Views/' . ucfirst($this->route['controller']) . '.php';
        if (file_exists($path)) {
            ob_start();
            require_once $path;
            $content = ob_get_clean();
            require_once APPPATH . 'Views/templates/' . $this->layout . '.php';
        } else {
            require_once APPPATH . 'Views/error/404.php';
        }
    }
}
