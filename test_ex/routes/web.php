<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Validation\Factory;

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



Route::get('/', [
	'uses' => 'App\Http\Controllers\LetterController@getIndex',
	'as' => 'letterIndex'
]);

Route::post('/', [
    'uses' => 'App\Http\Controllers\LetterController@postCreate',
    'as' => 'postCreate'
]);

Route::get('/sent/{id}', [
    'uses' => 'App\Http\Controllers\LetterController@ReadOwnLetter',
    'as' => 'ReadOwnLetter'
]);

Route::get('/manager', [
    'uses' => 'App\Http\Controllers\LetterController@managerListLetters',
    'as' => 'managerListLetters'
]);

// Route::get('/manager', function () {
//     return view('manager.index');
// });

// Route::post('/create', [
//     'uses': 'App\Http\Controllers\'
// ]);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
