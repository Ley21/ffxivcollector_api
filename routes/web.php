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

//Player

//$app->get('player', "PlayerController@index");
$app->post('player/xivdb', "PlayerController@storeXivdb");
$app->post('player/lodestone', "PlayerController@storeLodestone");
$app->put('player/{id}/xivdb', "PlayerController@updateXivdb");
$app->put('player/{id}/lodestone', "PlayerController@updateLodestone");
$app->get('player/{id}', "PlayerController@show");

//Minion

$app->get('minion', "MinionController@index");
$app->get('minion/latest', "MinionController@indexLatest");
$app->get('minion/{id}', "MinionController@show");
$app->post('minion', [
    'middleware' => App\Http\Middleware\BasicAuth::class,
    'uses' => "MinionController@store"]);
$app->put('minion/{id}', [
    'middleware' => App\Http\Middleware\BasicAuth::class,
    'uses' => "MinionController@update"]);
    
$app->post('minion/{id}/method', [
    'middleware' => App\Http\Middleware\BasicAuth::class,
    'uses' => "MinionController@storeMethod"]);
$app->put('minion/{id}/method', [
    'middleware' => App\Http\Middleware\BasicAuth::class,
    'uses' => "MinionController@updateMethodes"]);

//Mount

$app->get('mount', "MountController@index");    
$app->get('mount/latest', "MountController@indexLatest");   
$app->get('mount/{id}', "MountController@show");
$app->post('mount', [
    'middleware' => App\Http\Middleware\BasicAuth::class,
    'uses' => "MountController@store"]);
$app->put('mount/{id}', [
    'middleware' => App\Http\Middleware\BasicAuth::class,
    'uses' => "MountController@update"]);
    
$app->post('mount/{id}/method', [
    'middleware' => App\Http\Middleware\BasicAuth::class,
    'uses' => "MountController@storeMethod"]);
$app->put('mount/{id}/method', [
    'middleware' => App\Http\Middleware\BasicAuth::class,
    'uses' => "MountController@updateMethodes"]);
    
//Search
    
$app->get('search', ['as' => 'search', 'uses' => 'SearchController@search']);