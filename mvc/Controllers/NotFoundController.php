<?php

namespace Controllers;

use Controller;

class NotFoundController extends Controller
{
    public function index()
    {
        $data = [
            'route' => $this->getRouter()->getCurrentUri()
        ];

        $this->getTemplate()->setData($data);
        $this->getResponse()->setStatusCode(404);
        $this->getResponse()->setContent($this->getTemplate()->render('404'));
    }
}