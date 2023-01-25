<?php
function config($key=null)
{

    $config = require __DIR__ . '\..\config.php';
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
        return trim($data[$key]) ?? null;
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


function getIp()
{
    return ($_SERVER['HTTP_CLIENT_IP'] ?? null)
        ? ($_SERVER['HTTP_CLIENT_IP'] ?? null)
        : (($_SERVER['HTTP_X_FORWARDED_FOR'] ?? null)
            ? (($_SERVER['HTTP_X_FORWARDED_FOR'] ?? null))
            : ($_SERVER['REMOTE_ADDR'] ?? null));
}
function auth()
{
    $user = new \App\Models\User();
    $user = $user->find(['ip' => getIp()]);
    $email = $user['email'] ?? null;

    if (
        (
            isset($_COOKIE['USER_ID']) and
            hash_equals(
                hash_hmac('sha256', $email, 'ali'),
                $_COOKIE['USER_ID'])
        ) ||
        (
            isset($_SESSION['email']) and
            $_SESSION['email'] = $email
        )

    ) {
        return $user;
    }
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

