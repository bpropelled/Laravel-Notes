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
// */
// // Retuirn a string or html element
// Route::get('/', function () {
//     return 'yo yo yo yo';
// });

// //Passing Data to be returned as a JSON response
// Route::get('about', function () {
//     $response_array = [];
//     $response_array['author'] = 'Bob Sagat';
//     $response_array['version'] = '2.0';
//     $response_array['note'] = 'this is the notes';
//     return $response_array;
// });


// //Return view and pass data into it
// Route::get('/home', function(){

//     $data = [];
//     $data['version'] = '0.1';
//     return view('welcome', $data);
// });

// Route::get('/yo', 'PageController@yo');

Route::get('/about', 'PageController@about');
Route::get('/contact', 'PageController@contact');

Route::get('/articles','ArticlesController@index');
Route::get('/articles/latest','ArticlesController@latest');
Route::get('/articles/create', 'ArticlesController@create');
Route::get('/articles/api', 'ArticlesController@api');
Route::get('/articles/{id}', 'ArticlesController@show');

Route::post('articles', 'ArticlesController@store');


Route::get('mfgs', 'MfgController@all');
Route::get('cars', 'MfgController@cars');
Route::get('cars/{id}', 'MfgController@show');


Route::get('lease', 'LeasesController@index');
