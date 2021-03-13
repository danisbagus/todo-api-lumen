<?php

/** @var \Laravel\Lumen\Routing\Router $router */


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('/register', 'AuthController@register');

$router->post('/login', 'AuthController@login');

$router->get('/users/{id}', 'UserController@getDetail');


$router->group(['prefix' => 'tasks'], function () use ($router){

    $router->get('/', 'TaskController@getList');

    $router->get('/{id}', 'TaskController@getDetail');

    $router->post('/', 'TaskController@create');

    $router->patch('/{id}', 'TaskController@update');

    $router->delete('/{id}', 'TaskController@delete');
});



