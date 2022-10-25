<?php


use Bramus\Router\Router;
use DI\Container;
use Monolog\Logger;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Controller
{
    private Container $container;

    public function __construct()
    {
        //Router can`t create instances of Controllers with params by himself =[... global "kosti'l" instead
        //$router->get('/', 'HomeController@index');
        global $container;
        $container->injectOn($this);
        $this->container = $container;
    }

    public function getRequest(): Request
    {
        return $this->container->get('request');
    }

    public function getResponse(): Response
    {
        return $this->container->get('response');
    }

    public function getTemplate(): Template
    {
        return $this->container->get('template');
    }

    public function getLog(): Logger
    {
        return $this->container->get('log');
    }

    public function getRouter(): Router
    {
        return $this->container->get('router');
    }

}