<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome', [
        'noBreadcrumb' => true,
    ]);
});

Route::get('clients', function () {
    return view('clients', [
        'noBreadcrumb' => true,
    ]);
})->name('clients');

Route::get('alts', function () {
    return view('alts', [
        'noBreadcrumb' => true,
    ]);
})->name('alts');

Route::get('advertising', function () {
    return view('advertising', [
        'noBreadcrumb' => true,
    ]);
})->name('advertising');

Route::get('banned', function () {
    return view('roles.banned');
})->name('banned');

Route::get('unverified', function () {
    return view('roles.unverified');
})->name('unverified');

Route::get('docs', function () {
    return redirect()->away('http://docs.halfpetal.com');
})->name('api-docs');

Route::get('donate', function () {
    return redirect()->away('https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=K2N27BKHU7YKS');
})->name('donate');

Auth::routes();

Route::group([
    'prefix'    => 'mojang',
    'as'        => 'mojang::',
    'namespace' => 'Mojang',
], function () {
    Route::get('login', 'AuthController@showLogin')->name('getLogin');
    Route::post('login', 'AuthController@createSession')->name('postLogin');
    Route::get('logout', 'AuthController@destroySession')->name('getLogout');
    Route::get('usercp', 'AuthController@showUserCP')->name('getUserCP');
    Route::put('usercp/cape', 'AuthController@makeCapeActive')->name('putCapeActive');
    Route::delete('usercp/capes', 'AuthController@disableAllCapes')->name('disableAllCapes');
});

Route::group([
    'prefix'     => 'developer',
    'as'         => 'developer::',
    'namespace'  => 'Developer',
    'middleware' => ['role:developer|admin'],
], function () {
    Route::get('/', function () {
        return view('developer.dashboard', ['projects' => Projects::where('developer_id', '=', Auth::user()->id)->paginate()]);
    })->name('dashboard');

    Route::group([
        'prefix' => 'project',
        'as'     => 'project::',
    ], function () {
        Route::get('create', 'ProjectController@showCreateProject')->name('showCreateProject');
        Route::post('create', 'ProjectController@createProject')->name('createProject');

        Route::get('{hash}', function ($hash) {
            return redirect()->route('developer::project::capes', ['hash' => $hash]);
        })->where('hash', '[A-Za-z0-9]+');

        Route::delete('{hash}', 'ProjectController@deleteProject')->name('deleteProject')->where('hash', '[A-Za-z0-9]+');
        Route::put('{hash}', 'ProjectController@editProject')->name('editProject')->where('hash', '[A-Za-z0-9]+');

        Route::get('{hash}/capes', 'CapesController@getCapes')->name('capes')->where('hash', '[A-Za-z0-9]+');

        Route::get('{hash}/capes/create', 'CapesController@showCreateCape')->name('showCreateCape')->where('hash', '[A-Za-z0-9]+');
        Route::post('{hash}/capes/create', 'CapesController@createCape')->name('createCape')->where('hash', '[A-Za-z0-9]+');

        Route::get('{hash}/capes/edit/{capeHash}', 'CapesController@showEditCape')->name('showEditCape')->where(['hash' => '[A-Za-z0-9]+', 'capeHash' => '[A-Za-z0-9]+']);
        Route::put('{hash}/capes/edit/{capeHash}', 'CapesController@editCape')->name('editCape')->where(['hash' => '[A-Za-z0-9]+', 'capeHash' => '[A-Za-z0-9]+']);
        Route::delete('{hash}/capes/edit/{capeHash}', 'CapesController@deleteCape')->name('deleteCape')->where(['hash' => '[A-Za-z0-9]+', 'capeHash' => '[A-Za-z0-9]+']);

        Route::get('{hash}/capes/{capeHash}/users', 'UsersController@showUsers')->name('showCapeUsers')->where(['hash' => '[A-Za-z0-9]+', 'capeHash' => '[A-Za-z0-9]+']);
        Route::post('{hash}/capes/{capeHash}/users', 'UsersController@addUser')->name('addCapeUser')->where(['hash' => '[A-Za-z0-9]+', 'capeHash' => '[A-Za-z0-9]+']);
        Route::delete('{hash}/capes/{capeHash}/users', 'UsersController@removeUser')->name('removeCapeUser')->where(['hash' => '[A-Za-z0-9]+', 'capeHash' => '[A-Za-z0-9]+']);
    });
});

Route::group([
    'prefix'     => 'admin',
    'as'         => 'admin::',
    'namespace'  => 'Admin',
    'middleware' => ['role:admin'],
], function () {
    Route::get('/', 'AdminController@showDashboard')->name('dashboard');
    Route::get('developers', 'AdminController@showDevelopers')->name('developers');

    // users
    // banned

    Route::post('developer-user', 'AdminController@makeDeveloper')->name('makeDeveloper');
    Route::delete('developer-user', 'AdminController@stripDeveloper')->name('stripDeveloper');

    Route::post('ban-user', 'AdminController@banUser')->name('banUser');
    Route::delete('ban-user', 'AdminController@unbanUser')->name('unbanUser');
});
