<?php

namespace Controllers;

use Controller;
use Models\UserModel;

class HomeController extends Controller
{
    private array $errors = [];

    public function index(): void
    {
        $data = [
            'title' => 'The Form =]'
        ];

        $this->getTemplate()->setData($data);
        $this->getResponse()->setContent($this->getTemplate()->render('home'));
    }

    public function ajax_handler(): void
    {
        if ($this->getRequest()->getMethod() == 'POST') {
            $data = $this->getRequest()->toArray();

            if (!$this->isValid()) {
                $data['errors'] = $this->errors;
                $data['success'] = false;
            } else {
                $data['success'] = true;
            }

            $this->getResponse()->setStatusCode(200);
            $this->getResponse()->setContent(json_encode($data));
        }
    }

    private function isValid(): bool
    {
        $data = $this->getRequest()->toArray();

        if (strpos($data['email'], '@') === false) {
            $this->errors['error_email'] = 'Error: Email must contain @ symbol.';
        }

        if ($data['password'] !== $data['password_confirmation']) {
            $this->errors['error_passwords_not_equal'] = 'Error: Provided passwords not equal.';
        }

        $users = (new UserModel())->getUsers();
        if (array_search($data['email'], array_column($users, 'email')) !== false) {
            $this->errors['error_email_registered'] = 'Error: Email already registered. Provide another one or just login.';
        }

        if (!empty($this->errors)) {
            $this->getLog()->info('Validation results ->', $this->errors);
        }

        return empty($this->errors);
    }

}