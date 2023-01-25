<?php

namespace App\Controllers;

class AuthController
{
    public function authorize()
    {
        if (isset($_POST['remember'])) {
            if (isset($_COOKIE['USER_ID'])) {
                unset($_COOKIE['USER_ID']);
                setcookie('USER_ID', null, -1, '/');
            }
            setcookie('USER_ID');
            setcookie('USER_ID',hash_hmac('sha256', request('email'), 'ali'), time() + 3600 * 24 * 7);
            return redirect('/');
        }
        $_SESSION['email'] = request('email');
        return redirect('/');
    }
}