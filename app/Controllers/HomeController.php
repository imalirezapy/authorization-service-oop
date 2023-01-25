<?php

namespace App\Controllers;

class HomeController
{
    public function index()
    {

        if (!auth()) {
            return redirect('login');
        }

        return view('home');
    }
}