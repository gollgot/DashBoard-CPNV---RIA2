<?php
namespace App\controllers;



use Slim\Http\Request;
use Slim\Http\Response;

class HomeController extends Controller {


    public function ActionIndex(Request $request, Response $response){
        $this->render($response, "home/index.twig", [
            'name' => 'loïc'
        ]);
    }

    /*
    public function ActionTest(Request $request, Response $response){
        $this->render($response, "home/test.twig");
    }
    */

}