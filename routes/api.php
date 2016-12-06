<?php


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

Route::get('ping', function () {
    return 'pong';
})->name('api::ping');

Route::group([
    'prefix' => 'v1',
    'as' => 'api::v1::',
    'namespace' => 'API\v1'
], function() {
    Route::group([
        'prefix' => '{uuid}',
        'as' => 'user::'
    ], function() {
        Route::get('getCape', 'UserController@getCape')->name('getCape');
        Route::post('addCape', 'UserController@addCape')->name('addCape');
        Route::get('hasCape/{capeHash}', 'UserController@hasCape')->where('capeHash', '[A-Za-z0-9]+')->name('hasCape');
    });
});

// /uuid/getCape
// /uuid/hasCape/hash
// /uuid/addCape