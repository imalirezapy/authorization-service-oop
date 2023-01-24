<?php

namespace App\Controllers;

use App\Helpers\Request;
use App\Helpers\Route;
use App\Helpers\Validation;

class RegisterController
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
        dd('koeye');
    }
}