<?php

use App\controllers\HomeController;

$app
    ->get('/', HomeController::class.":ActionIndex")
    ->setName("home");

$app
    ->get('/test', HomeController::class.":ActionTest")
    ->setName("test");