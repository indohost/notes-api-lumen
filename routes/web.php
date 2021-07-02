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

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('/login', 'AuthController@login');
    $router->post('/register', 'AuthController@register');

    $router->group(['middleware' => 'auth'], function () use ($router) {
        $router->post('/logout', 'AuthController@logout');

        // Notes
        $router->group(['prefix' => 'notes'], function () use ($router) {
            $router->get('/', 'NotesController@index');
            $router->post('/', 'NotesController@store');
            $router->put('/{id}', 'NotesController@update');
            $router->delete('/{id}', 'NotesController@destroy');
        });
        // Tags
        $router->group(['prefix' => 'tags'], function () use ($router) {
            $router->get('/', 'TagsController@index');
            $router->post('/', 'TagsController@store');
            $router->put('/{id}', 'TagsController@update');
            $router->delete('/{id}', 'TagsController@destroy');
        });
    });
});
