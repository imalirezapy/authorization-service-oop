<?php

namespace App\Helpers;

use http\QueryString;

class Request
{
    static public function all($keys=[]) : array
    {
        if (!$keys) {
            $request = [];
            foreach (request() as $key => $value) {
                if (in_array($key, $keys)) {
                    $request[$key] = $value;
                }
            }
            return $request;
        }
        return request();
    }

    static public function url() : string
    {
        $url = $_SERVER['REQUEST_URI'];

        $position = strpos($url, '?');

        if ($position !== false) {
            $url = substr($url, 0, $position);
        }
        return $url;
    }

    static public function method() : string
    {
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        if ($method == 'get') {
            return $method;
        }

        if (isset($_POST['_method'])) {
            $method = strtolower($_POST['_method']);
            if (in_array($method, ['put', 'patch', 'delete'])) {
                return $method;
            };
        }

        return 'post';
    }

    static public function isMethod(string $value) : string
    {
        return self::method() === strtolower(trim($value));
    }

}