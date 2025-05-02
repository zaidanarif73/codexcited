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

//AUTH
Route::group(["namespace" => "App\Http\Controllers\Auth", "as" => "auth.", "prefix" => "auth"], function () {
    Route::group(["as" => "login.", "prefix" => "login"], function () {
        Route::get("/", "LoginController@index")->name("index");
        Route::post("/", "LoginController@post")->name("post");
    });

    Route::get("/logout", "LogoutController@logout")->name('logout');
    
    Route::group(["as" => "signup.", "prefix" => "signup"], function () {
        Route::get("/", "SignUpController@index")->name("index");
        Route::post("/", "SignUpController@post")->name("post");
    });
});

//GUEST ROUTES
Route::group(["namespace" => "App\Http\Controllers\Guest", "as" => "guest."], function () {
    Route::get("/", "HomeController@index");
});

//TEACHER ROUTES
Route::group(["middleware" => ["dashboard.access"], "namespace" => "App\Http\Controllers\Teacher", "as" => "teacher.", "prefix" => "teacher"], function () {
    Route::get("/", "DashboardController@index")->name('dashboard.index');
});

//STUDENT ROUTES
Route::group(["middleware" => ["dashboard.access"], "namespace" => "App\Http\Controllers\Student", "as" => "student.", "prefix" => "student"], function () {
    Route::get("/", "DashboardController@index")->name('dashboard.index');

    Route::group(["as" => "materi.", "prefix" => "materi"], function () {
        Route::get("/", "MateriController@index")->name('index');
    });

    Route::group(["as" => "discussion.", "prefix" => "discussion"], function () {
        Route::get("/", "DiscussionController@index")->name('index');
    });

    Route::group(["as" => "leaderboard.", "prefix" => "leaderboard"], function () {
        Route::get("/", "LeaderboardController@index")->name('index');
    });

    Route::group(["as" => "profile.", "prefix" => "profile"], function () {
        Route::get("/", "ProfileController@index")->name('index');
        Route::put("/", "ProfileController@update")->name('update');
    });


});

