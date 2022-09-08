<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Validation\Factory;
// use App\Http\Middleware\isAdmin;

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

Route::get('/letters/{id}', [
    'uses' => 'App\Http\Controllers\LetterController@readAllLetters',
    'as' => 'readAllLetters'
]);

Route::get('/manager', [
    'uses' => 'App\Http\Controllers\ManagerController@managerListLetters',
    'as' => 'managerListLetters'
]);

Route::post('/manager/post/{id}', [
    'uses' => 'App\Http\Controllers\ManagerController@managerPostLetters',
    'as' => 'managerPostLetters'
]);
Route::get('/manager/get/{id}', [
    'uses' => 'App\Http\Controllers\ManagerController@managerGetLetter',
    'as' => 'managerGetLetter'
]);
Route::post('/manager/respond/{id}', [
    'uses' => 'App\Http\Controllers\ManagerController@respondLetter',
    'as' => 'respondLetter'
]);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

