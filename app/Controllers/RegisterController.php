<?php

namespace App\Controllers;

use App\Helpers\Request;
use App\Helpers\Route;

class RegisterController
{
    public function index()
    {
        return view('register');

    }

    public function store()
    {
        dd(request());
    }
}