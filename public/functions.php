<?php
function config($key=null)
{
    $config = require_once '../config.php';
    if (is_null($key)) {
        return $config;
    }

    return $config[$key] ?? null;
}

function dd()
{
    $args = func_get_args();
    echo "<pre>";
    var_dump(...$args);
    echo "</pre>";
    die();
};

function query(string $key=null)
{
    $data = filter_input_array(INPUT_GET, FILTER_SANITIZE_SPECIAL_CHARS);

    if (!is_null($key)) {
        if (isset($data[$key])) {
            return urldecode($data[$key]);
        }
        return null;
    }

    return $data;
}


function request(string $key=null)
{
    $data = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

    if (!is_null($key)) {
        return $data[$key] ?? null;
    }

    return $data;
}

function view($path, $data=[])
{
    extract($data);

    return require __DIR__ . '/../views'. '/'.$path.'.view.php';
}

function abort($code)
{
//    http_response_code($code);

    return view($code);
}

function auth()
{
//    if ((
//            isset($_COOKIE['token']) and
//            hash_equals(
//                hash_hmac('sha256', $username, $key),
//                $_COOKIE['token']
//            )) ||
//        (isset($_SESSION['username']) and
//            $_SESSION['username'] == $username
//        )) {
//        echo 'Hello from Quera!';
//    } else {
//        header('Location: login.html');
//        die();
//    }

    return false;
}

function redirect($url)
{

    echo "<script>window.location.replace('{$url}')</script>";
    return true;
}

function error($key)
{
    if (!isset($_SESSION['errors'][$key])) {
        return false;
    }

    $error = $_SESSION['errors'][$key];
    unset($_SESSION['errors'][$key]);
    return $error;
}

