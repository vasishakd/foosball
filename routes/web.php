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

Auth::routes();

Route::post('/winners', [\App\Http\Controllers\WinnerController::class, 'store'])->name('winners.store');
Route::view('/registration', 'auth.registration')->name('auth.registration');
Route::view('/', 'main.index')->name('main.index');

Route::get('robots.txt', 'RobotsController')->name('robots');
Route::get('sitemap.xml', 'SitemapController')->name('sitemap');
