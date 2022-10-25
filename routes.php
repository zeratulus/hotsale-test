<?php

/**
 * Created in framework.php
 * This file used to define routes
 * @var \Bramus\Router\Router $router
 */

$router->get('/', 'HomeController@index');
$router->get('index.php', 'HomeController@index');
$router->post('ajax_handler', 'HomeController@ajax_handler');

$router->set404(function() {
    (new Controllers\NotFoundController())->index();
});