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
    return view('welcome');
});

Auth::routes();

Route::group([
	'prefix' => 'developer',
	'as' => 'developer::',
	'namespace' => 'Developer',
	'middleware' => ['role:developer|admin']
], function() {
	Route::get('/', function() {
		return view('developer.dashboard');
	})->name('dashboard');

	Route::group([
		'prefix' => 'project',
		'as' => 'project::'
	], function() {
		Route::get('create', 'ProjectController@showCreateProject')->name('showCreateProject');
		Route::post('create', 'ProjectController@createProject')->name('createProject');

		Route::get('{hash}', function() {
			return redirect()->route('developer::project::capes')->with('hash');
		})->where('hash','[A-Za-z0-9]+');

		Route::get('{hash}/capes', 'CapesController@getCapes')->name('capes')->where('hash', '[A-Za-z0-9]+');

		Route::get('{hash}/capes/create', 'CapesController@showCreateCape')->name('showCreateCape')->where('hash', '[A-Za-z0-9]+');
		Route::post('{hash}/capes/create', 'CapesController@createCape')->name('createCape')->where('hash', '[A-Za-z0-9]+');

		Route::get('{hash}/capes/edit/{capeHash}', 'CapesController@showEditCape')->name('showEditCape')->where(['hash' => '[A-Za-z0-9]+', 'capeHash' => '[A-Za-z0-9]+']);
		Route::post('{hash}/capes/edit/{capeHash}', 'CapesController@editCape')->name('editCape')->where(['hash' => '[A-Za-z0-9]+', 'capeHash' => '[A-Za-z0-9]+']);
		Route::delete('{hash}/capes/edit/{capeHash}', 'CapesController@deleteCape')->name('deleteCape')->where(['hash' => '[A-Za-z0-9]+', 'capeHash' => '[A-Za-z0-9]+']);
	});
});

Route::group([
	'prefix' => 'admin',
	'as' => 'admin::',
	'middleware' => ['role:admin']
], function() {
	Route::get('/', function() {
		return 'hello admin';
	});
});

Route::get('docs', function() {
	return 'documentation';
})->name('api-docs');

Route::get('donate', function() {
	return 'documentation';
})->name('donate');