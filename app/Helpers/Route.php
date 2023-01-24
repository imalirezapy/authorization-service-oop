<?php

namespace App\Helpers;

class Route
{
    protected $routesMap = [
        'get' => [],
        'post' => [],
        'put' => [],
        'delete' => [],
        'patch' => []
    ];
    public function get(string $url, array $callback)
    {


        $this->routesMap['get'][$url] = $callback;
    }


    public function post(string $url, array $callback)
    {

        $this->routesMap['post'][$url] = $callback;
    }


    public function delete(string $url, array $callback)
    {

        $this->routesMap['delete'][$url] = $callback;
    }


    public function put(string $url, array $callback)
    {

        $this->routesMap['put'][$url] = $callback;
    }


    public function patch(string $url, array $callback)
    {

        $this->routesMap['patch'][$url] = $callback;
    }


    protected function getCallbackFromDynamicRoute()
    {


        $method = Request::method();
        $url = Request::url();

        $routes = $this->routesMap[$method];

        foreach ($routes as $route => $callback) {
            $routeNames = [];
            if (!$route) {
                continue;
            }

            if (preg_match_all('/\{(\w+)(:[^}]+)?}/', $route, $matches)) {
                $routeNames = $matches[1];
            }

            $routeRegex = $this->convertRouteToRegex($route);

            if (preg_match_all($routeRegex, $url, $matches)) {
                $values = [];
                unset($matches[0]);
                foreach ($matches as $match) {
                    $values[] = $match[0];
                }


                $routeParams = array_combine($routeNames, $values);


                return [$callback, $routeParams];
            }



        }

        return false;
    }


    public function solve()
    {


        $method = Request::method();
        $url = Request::url();

        $callback = $this->routesMap[$method][$url] ?? false;
        $params = [];
        if (!$callback) {

            $routeCallback = $this->getCallbackFromDynamicRoute();

            if (!$routeCallback) {
                return abort(404);
            }

            $callback = $routeCallback[0];
            $params = $routeCallback[1];
        }

        return call_user_func([new $callback[0], $callback[1]], ...array_values($params));
    }


    protected function convertRouteToRegex(string $route) : string
    {

        return "@^" . preg_replace_callback(
                '/\{\w+(:([^}]+))?}/',
                fn($m) => isset($m[2]) ? "($m[2])" : '([-\w]+)',
                $route
            ) . "$@";


    }
}