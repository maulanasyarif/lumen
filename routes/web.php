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

$router->post('/register', 'UserController@register');
$router->post('/login', 'UserController@login');
$router->post('/logout', 'UserController@logout');

$router->get('/jenis', 'JenisController@index');
$router->post('/Createjenis', 'JenisController@create');
$router->get('/Showjenis/{id}', 'JenisController@show');
$router->put('/Updatejenis/{id}', 'JenisController@update');
$router->delete('/Deletejenis/{id}', 'JenisController@destroy');

$router->get('/book', 'BookController@index');
$router->post('/Createbook', 'BookController@create');
$router->get('/Showbook/{id}', 'BookController@show');
$router->put('/Updatebook/{id}', 'BookController@update');
$router->delete('/Deletebook/{id}', 'BookController@destroy');