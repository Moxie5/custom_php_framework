<?php
/**
 * User: Moxie5
 * Author: Dobromir Dobrev
 * Created with educational purposes 
 */

namespace App\Core;

class Core
{
    public Router $router;
    public Request $request;

    public function __construct()
    {
        $this->request = new Request();
        $this->router = new Router($this->request);
    }

    public function run()
    {
        $this->router->resolve();
    }
}
