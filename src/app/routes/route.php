<?php

use App\controllers\HomeController;

$app
    ->get('/', HomeController::class.":ActionIndex")
    ->setName("home");

$app
    ->get('/dashboard', HomeController::class.":ActionDashboard")
    ->setName("dashboard");
