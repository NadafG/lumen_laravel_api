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

$router->get('/produts', 'ProductController@index');
$router->get('/produts/{id}', 'ProductController@show');
$router->post('/produts/create', 'ProductController@store');
$router->put('/produts/update/{id}', 'ProductController@update');
$router->delete('/produts/delete/{id}', 'ProductController@destroy');

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('/register', 'AuthController@register');
    $router->post('/login', 'AuthController@login');

});
