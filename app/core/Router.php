<?php

namespace App\core;

use Bramus\Router\Router as Route;

class Router
{
    // public Router $router;
    // public array $router_files = [];
    public $base_path;
    public $namespace_controllers;

    // public function __construct()
    // {
    //     $this->router = new Router();
    // }

    public function run()
    {

        $router = new Route();

        $router->setBasePath($this->base_path);

        $router->setNamespace($this->namespace_controllers);

        $files = scandir(__DIR__ . '/../../routes');
        $routersFiles = $files;
        foreach ($routersFiles as $route) {
            if ($route === '.' || $route === '..') {
                continue;
            }

            // load router files
            require_once __DIR__ . '/../../routes/' . $route;
        }
        
        // Set Error 404
        $router->set404('ErrorController@error');

        // Run it!
        $router->run();
    }
}
