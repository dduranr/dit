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

// Auth::routes();
Auth::routes([
    'reset' => false,    // Deshabilitar Reset Password
    'verify' => false,   // Deshabilitar Verification de email
]);

Route::get('/home', 'HomeController@index')->name('home');

// Aquí declaro las rutas (Laravel tiene la opción de generarlas todas de una vez, utilizando el método resource de la clase Route, así sólo utilizamos una sola línea)
Route::resource('books', 'BookController');
Route::get('books.datatables', 'BookController@datatables')->name('books.datatables');
Route::patch('books/{book}/available', 'BookController@available')->name('books.available');
Route::get('categories.getForAutocomplete', 'CategoryController@getForAutocomplete')->name('categories.getForAutocomplete');