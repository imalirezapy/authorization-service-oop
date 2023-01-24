<?php namespace App\Helpers;

class Validation
{

    protected $key;
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['errors'] = [];
    }

    protected function setError($message)
    {
        $_SESSION['errors'][$this->key] = $message;
    }
    public function required()
    {
        if (is_null(request($this->key)) || trim(request($this->key)) == '') {
            $this->setError('this field is required!');
        }
    }

    public function min(int $num)
    {
        if (ctype_digit($this->key)) {
            if (request($this->key) < $num) {
                $this->setError("Value should be greater than $num!");
            }
        } else {
            if (strlen(request($this->key)) < $num) {
                $this->setError("Value should be greater than $num character!");

            }
        }

    }
    public function max(int $num)
    {
        if (ctype_digit($this->key)) {
            if (request($this->key) > $num) {
                $this->setError( "Value should be less than $num!");
            }
        } else {
            if (strlen(request($this->key)) > $num) {
                $this->setError("Value should be less than $num character!");

            }
        }

    }

    public function between(int $num1, int $num2)
    {
        if (ctype_digit($this->key)) {
            if (request($this->key) > $num2 or request($this->key) < $num1) {
                $this->setError( "Value should be between $num1 and $num2!");
            }
        } else {

            if (request(strlen(request($this->key))) > $num2 or request(strlen(request($this->key))) < $num1) {
                $this->setError("Value should be between $num1 and $num2 character!");

            }
        }
    }

    public function numeric()
    {
        if (!ctype_digit(request($this->key))) {
            $this->setError('Value should be numeric!');
        }
    }


     public function validate($rules)
    {

        foreach ($rules as $key => $rule) {

            foreach ($rule as $item) {
                if (key_exists($key, $_SESSION['errors'])) {
                    continue;
                }
                $item = explode(':', $item);
                $params = explode(',', $item[1] ?? null);
                $this->key = $key;
                call_user_func([$this, $item[0]], ...$params);
            }
        }

        return (bool) $_SESSION['errors'];
    }
}