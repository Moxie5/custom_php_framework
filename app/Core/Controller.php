<?php
/**
 * User: Moxie5
 * Author: Dobromir Dobrev
 * Created with educational purposes 
 */

namespace App\Core;

class Controller
{
    public $view;
    public $model;
    public $request;
    public Session $session;

    public function __construct()
    {
        $this->request = new Request;
        $this->session = new Session;
        $this->model = $this->Model();
        $this->view = new View($this->session);
    }

    public function Model($model = null)
    {
        $path = 'App\Models\\' . ucfirst($model);
        if (class_exists($path)) {
            return new $path;
        }
    }

    public function json_response($status, $message)
    {
        exit(json_encode(['status' => $status, 'message' => $message]));
    }

    public function json_location($url)
    {
        exit(json_encode(['url' => $url]));
    }
}
