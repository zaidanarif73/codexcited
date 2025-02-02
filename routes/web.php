<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//STUDENT ROUTES
// Route::get('/', function () {
//     return view('welcome');
// });
Route::group(["namespace" => "App\Http\Controllers\Student", "as" => "student."], function () {
    Route::get("/", "HomeController@index");
});

