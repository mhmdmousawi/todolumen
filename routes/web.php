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
        $router->delete('tasks/{id}', 'TasksController@delete');

        $router->get('categories/{id}', 'CategoriesController@viewCategory');
        $router->post('categories', 'CategoriesController@create');
        $router->put('categories/{id}', 'CategoriesController@update');
        $router->get('categories', 'CategoriesController@list');
        $router->delete('categories/{id}', 'CategoriesController@delete');
});

$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->post('register', 'JWTAuthController@register');
    $router->post('login', 'JWTAuthController@login');
    $router->post('logout', 'JWTAuthController@logout');
    $router->post('refresh', 'JWTAuthController@refresh');
});
