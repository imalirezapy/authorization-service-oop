<?php

namespace App\Controllers;

use App\Helpers\Validation;
use App\Models\User;

class RegisterController extends AuthController
{
    public function index()
    {
        return view('register');

    }

    public function store()
    {
        $validate = (new Validation)->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:User'],
            'password' => ['required', 'password']
        ]);

        if ($validate) {
            return redirect('/register');
        }

        $user = new User();
        $user->create(
            [
                'username' => \request('name'),
                'email' => \request('email'),
                'password' => md5(\request('password'))
            ]
        );

        return $this->attempt();
    }
}