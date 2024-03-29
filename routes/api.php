<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * @var \Illuminate\Routing\Router $router
 **/

$router->middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Review Resource Controller Routes
$router->group([ 'prefix' => 'reviews', 'middleware' => [ 'jsonify' ], 'namespace' => 'API' ], function () use ($router) {
    $router->get('', 'ReviewController@index');
    $router->post('', 'ReviewController@store');
    $router->delete('{reviewId}', 'ReviewController@destroy');
});
