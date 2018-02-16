<?php

$container = $app->getContainer();
// Register component on container

// Load twig template for the view, with no cache for dev mode
$container['view'] = function ($container) {
    $dir = dirname(__DIR__);
    $view = new \Slim\Views\Twig($dir."/app/views", [
        'cache' => false//$dir."/tmp/cache"
    ]);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));

    return $view;
};