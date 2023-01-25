<?php namespace App\Controllers;
use App\Helpers\Validation;
use App\Models\User;

class LoginController extends AuthController
{

    protected function attempt(array $data)
    {
        $user = new User();
        $result = $user->find(['email' => $data['email']]);
        if ($result) {
            if ($result['password'] === md5($data['password'])) {
                return $this->authorize();
            };
        }
        $_SESSION['errors']['email'] = 'Email or Password is wrong!';
        return redirect('/login');
    }
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


        return $this->attempt(['email' => request('email'), 'password' => request('password')]);
    }

    public function logout()
    {
        if (isset($_SESSION['email'])) {
            unset($_SESSION['email']);
        }
        if (isset($_COOKIE['USER_ID'])) {
            unset($_COOKIE['USER_ID']);
            setcookie('USER_ID', null, -1, '/');
        }
        return redirect('/login');
    }
}