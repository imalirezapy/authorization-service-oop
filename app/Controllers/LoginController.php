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
            'email' => ['required', 'email'],
            'password' => ['required', 'password']
        ]);

        if ($validate) {
            return redirect('/login');
        }
        #TODO: verify user (Login)
        dd('koeye');
    }
}