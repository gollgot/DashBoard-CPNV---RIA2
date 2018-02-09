<?php

namespace App\controllers;


use function FastRoute\TestFixtures\empty_options_cached;
use Slim\Http\Response;

class Controller
{
    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    // Function that can be use by all child controller to render a view with or without parameters
    protected function render(Response $response, $view, $params = []){
        $this->container->view->render($response, $view, $params);
    }

}