<?php namespace App\Controllers;
use App\Helpers\Validation;

class LoginController
{
    public function index()
    {
        return view('login');
    }


    public function verify()
    {
        $validate = (new Validation)->validate([
            'email' => ['required' ],
            'password' => ['required', 'between:1,3', 'numeric']
        ]);

        if ($validate) {
            return view('login');
        }
        dd('koeye');
    }
}