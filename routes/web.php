<?php use App\Helpers\Route;

use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\RegisterController;

$route = new Route();


$route->get('/', [HomeController::class, 'index']);

$route->get('/login', [LoginController::class, 'index']);
$route->post('/login', [LoginController::class, 'verify']);


$route->get('/register', [RegisterController::class, 'index']);
$route->post('/register', [RegisterController::class, 'store']);

$route->solve();