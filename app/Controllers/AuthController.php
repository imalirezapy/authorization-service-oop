<?php

namespace App\Controllers;

class AuthController
{
    public function attempt()
    {
        #TODO: Set Cookie or Session
        if (isset($_POST['remember'])) {
            dd('set cookie');
        }
        dd('set session');
    }
}