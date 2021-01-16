<?php

use Illuminate\Http\Request;

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
// Closure breacking php artisan route:cache
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/login', function (Request $request) {
    $response = [];
    $response['status'] = 'success'; //success or error
    $response['message'] = ''; //error text;

    return response()->json($response);
});

Route::post('/registration', function (Request $request) {
    $response = [];
    $response['status'] = 'success'; //success or error
    $response['message'] = ''; //error text;

    return response()->json($response);
});

Route::get('/randomize', function (Request $request) {
    $response = [];
    $response['status'] = 'success'; //success or error
    $response['message'] = ''; //error text;
    $response['data'] = [
        'players' => [
            [
                'id' => 1,
                'name' => 'Dr. Alisa Chimy',
                'slogan' => 'Physics',
                'rating' => 23,
                'image' => asset('/images/avatar-2.svg'),
            ],
            [
                'id' => 2,
                'name' => 'Domona',
                'slogan' => 'English Teacher',
                'rating' => -10,
                'image' => asset('/images/avatar-3.svg'),
            ],
            [
                'id' => 3,
                'name' => 'Penny Tinky',
                'slogan' => 'Subtitle or short details',
                'rating' => 183,
                'image' => asset('/images/avatar-4.svg'),
            ],
            [
                'id' => 4,
                'name' => 'Domona',
                'slogan' => 'English Teacher',
                'rating' => -10,
                'image' => asset('/images/avatar-3.svg'),
            ],
        ]
    ];

    return response()->json($response);
});
