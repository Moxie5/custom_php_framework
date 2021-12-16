<?php
/**
 * User: Moxie5
 * Author: Dobromir Dobrev
 * Created with educational purposes 
 */

namespace App\Core;

class Request
{
    public function getPath()
    {
        $parse_url = parse_url($_SERVER['REQUEST_URI']);
        $url = filter_var($parse_url['path'], FILTER_SANITIZE_URL);
        return $url;
    }

    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function get()
    {
        $get = array();
        if ($this->getMethod() === 'GET') {
            foreach ($_GET as $key => $value) {
                $get[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        return $get;
    }

    public function post()
    {
        $post = array();
        if ($this->getMethod() === 'POST') {
            foreach ($_POST as $key => $value) {
                $post[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        return $post;
    }

    public function isJson()
    {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            return true;
        }
        return false;
    }

    public function errorCode($code)
    {
        http_response_code($code);
        $path = APPPATH . 'Views/error/' . $code . '.php';
        if (file_exists($path)) {
            require_once $path;
        }
        exit;
    }
}
