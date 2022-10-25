<?php

use Bramus\Router\Router;
use DI\Container;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Psr\Log\LogLevel as Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require_once 'config.php';
require_once 'vendor/autoload.php';

$container = new Container();
$GLOBALS['container'] = $container;
$container->set('request', Request::createFromGlobals());
$response = new Response();
$container->set('response', $response);
$container->set('template', new Template());

$router = new Router();
$router->setNamespace('\Controllers');
$container->set('router', $router);

require_once ('routes.php');

$logger = new Logger('global');
$logger->pushHandler(new StreamHandler(DIR_LOG . '/global.log', Level::INFO));
$container->set('log', $logger);

$router->run();

$response->send();