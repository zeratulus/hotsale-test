<?php


namespace Models;


class UserModel
{

    public function getUsers(): array
    {
        return [
            [
                'id' => 0,
                'email' => 'someemail@domain.com',
                'name' => 'Test Testovich'
            ],
            [
                'id' => 999,
                'email' => 'admin@domain.com',
                'name' => 'Root Adminovich'
            ],
            [
                'id' => 777,
                'email' => 'ailus665@gmail.com',
                'name' => 'Serhii Herenko'
            ]
        ];
    }

}