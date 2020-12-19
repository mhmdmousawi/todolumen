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

use Illuminate\Support\Facades\Mail;
use App\Mail\MyEmail;

$router->get('email', function() {

    Mail::send("my-email", [], function($message) {
        $message->to('somebody@example.org')->subject("Welcome my Friend!");

    });

    return view('my-email');
});

$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->post('register', 'JWTAuthController@register');
    $router->post('login', 'JWTAuthController@login');
    $router->post('logout', 'JWTAuthController@logout');
    $router->post('refresh', 'JWTAuthController@refresh');
});
