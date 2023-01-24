<?php

namespace App\Controllers;

class HomeController
{
    public function index()
    {
        if (!auth()) {
            return redirect('login');
        }

//        dd('home');
        return view('home');
    }
}