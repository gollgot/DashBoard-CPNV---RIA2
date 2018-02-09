<?php

require "../vendor/autoload.php";

$app = new \Slim\App([
    "settings" => [
        "displayErrorDetails" => true // Put to false in production
    ]
]);

require("../app/container.php");



// Include all our routes
require "../app/routes/route.php";




$app->run();