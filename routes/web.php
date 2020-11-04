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

Route::post('/winners', [\App\Http\Controllers\WinnerController::class, 'store'])->name('winners.store');

Route::view('/', 'layouts.app')->name('main');
Route::view('/login', 'login.show')->name('login.show');

Route::get('robots.txt', 'RobotsController')->name('robots');
Route::get('sitemap.xml', 'SitemapController')->name('sitemap');
