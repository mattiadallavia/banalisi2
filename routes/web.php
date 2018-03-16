<?php

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
$router->get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

$router->get('definizioni', ['as' => 'definizioni.index', 'uses' => 'DefinizioniController@index']);
$router->get('definizioni/{codice}', ['as' => 'definizioni.show', 'uses' => 'DefinizioniController@show']);

$router->get('teoremi', ['as' => 'teoremi.index', 'uses' => 'TeoremiController@index']);
$router->get('teoremi/{codice}', ['as' => 'teoremi.show', 'uses' => 'TeoremiController@show']);