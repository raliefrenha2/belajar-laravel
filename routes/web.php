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

Route::get('products/{id}', function ($productId) {
    return "Produk $productId";
});

Route::get('products/{id}/items/{item_id}', function ($productId, $itemId) {
    return "Produk $productId, item $itemId";
});

Route::get('/categories/{id}', function ($categoryId) {
    return "Kategori $categoryId";
})->where('id', '[0-9]+');

// Optional Parameter
Route::get('users/{id?}', function (string $userId = '404') {
    return "User $userId";
});

Route::get('controller/hello', [\App\Http\Controllers\HelloController::class, 'hello']);