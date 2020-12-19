<?php

/** @var Router $router */
use Laravel\Lumen\Routing\Router;

$router->group([
    'middleware' => 'auth',
], function() use ($router) {
        $router->get('tasks', 'TasksController@list');
        $router->get('tasks/{id}', 'TasksController@viewTask');
        $router->post('tasks', 'TasksController@create');
        $router->put('tasks/{id}', 'TasksController@update');
});

$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->post('register', 'JWTAuthController@register');
    $router->post('login', 'JWTAuthController@login');
    $router->post('logout', 'JWTAuthController@logout');
    $router->post('refresh', 'JWTAuthController@refresh');
});
