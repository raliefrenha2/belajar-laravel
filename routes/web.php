<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/test', function () {
    return "Romi Alief Rahman";
});


Route::redirect('/youtube', '/test');

Route::fallback(function () {
    return '404 by ai.romi';
});

Route::view('/hello', ['name' => 'Romi Alief Rahman']);

Route::get('/hello-again', function () {
    return view('hello', ['name' => 'Romi Alief Rahman']);
});

Route::get('hello-nested', function () {
    return view('nested.hello', ['name' => 'Romi Alief Rahman']);
});