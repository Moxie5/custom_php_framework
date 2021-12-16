<?php
/**
 * User: Moxie5
 * Author: Dobromir Dobrev
 * Created with educational purposes 
 */

namespace App\Core;

class Router
{
    private $request;
    private array $handlers;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function add(string $path, $handler): void
    {
        $this->handlers[$path] = [
            'path' => $path,
            'handler' => $handler
        ];
    }

    public function resolve()
    {
        $url = $this->request->getPath();
        $routes = null;
        foreach ($this->handlers as $handler) {
            if ($handler['path'] === $url) {
                $routes = $handler['handler'];
            }
        }

        if (is_array($routes)) {
            $parts = array_shift($routes);
            if (is_string($parts)) {
                $className = $parts;
                if (class_exists($className)) {
                    $method = array_shift($routes);
                    //Check if method exists within class 
                    if (method_exists($className, $method)) {
                        $controller = new $className;
                        $controller->$method();
                    } else {
                        $this->request->errorCode(404);
                    }
                } else {
                    $this->request->errorCode(404);
                }
            }
        } else {
            $this->request->errorCode(404);
        }
    }
}
