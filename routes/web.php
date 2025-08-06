<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\MateriProgressController;
use App\Enums\RoleEnum;

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
Route::group(["namespace" => "App\Http\Controllers\Guest", "as" => "guest." ], function () {
    Route::get("/", "HomeController@index");

    Route::get("/materi", "MateriController@index")->name('materi.index');
});

//TEACHER ROUTES
Route::group(["middleware" => ["teacher.access"], "namespace" => "App\Http\Controllers\Teacher", "as" => "teacher.", "prefix" => "teacher"], function () {
    Route::get("/", "DashboardController@index")->name('dashboard.index');

    Route::group(["as" => "materi.", "prefix" => "materi"], function () {
        Route::get("/", "MateriController@index")->name('index');
        Route::get("/create", "MateriController@create")->name('create');
        Route::post("/", "MateriController@store")->name('store');
        Route::get("/{id}/edit", "MateriController@edit")->name('edit');
        Route::put("/{id}", "MateriController@update")->name('update');
        Route::delete("/{id}", "MateriController@destroy")->name('destroy');
        Route::get("/{id}/detail", "MateriController@show")->name('show');
        Route::post("/{id}/detail", "MateriController@storeDetail")->name('detail.store');
        Route::get("/{materi}/detail/{detail}/edit", "MateriController@editDetail")->name('detail.edit');
        Route::put("/{materi}/detail/{detail}", "MateriController@updateDetail")->name('detail.update');
        Route::delete("/{materi}/detail/{detail}", "MateriController@destroyDetail")->name('detail.destroy');

        // Rute kuis untuk setiap materi
        Route::get("/{materi}/kuis", "KuisController@index")->name('kuis.index');
        Route::get("/{materi}/kuis/create", "KuisController@create")->name('kuis.create');
        Route::post("/{materi}/kuis", "KuisController@store")->name('kuis.store');
        Route::get("/{materi}/kuis/{kuis}/edit", "KuisController@edit")->name('kuis.edit');
        Route::put("/{materi}/kuis/{kuis}", "KuisController@update")->name('kuis.update');
        Route::delete("/{materi}/kuis/{kuis}", "KuisController@destroy")->name('kuis.destroy');
        
    });
});

//STUDENT ROUTES
Route::group(["middleware" => ["student.access"], "namespace" => "App\Http\Controllers\Student", "as" => "student.", "prefix" => "student"], function () {
    Route::get("/", "DashboardController@index")->name('dashboard.index');

    Route::group(["as" => "materi.", "prefix" => "materi"], function () {
        Route::get("/", "MateriController@index")->name('index');
        Route::post("/score/add", "MateriController@addScore")->name('score.addScore');

        Route::get('/code/{id}', 'MateriController@code')->name('code');

        Route::get("/{id}/{slug}", "MateriController@show")->name('show');
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

    //kuis
    Route::group(["as" => "kuis.", "prefix" => "kuis"], function () {
        Route::get("/{materi_id}", "KuisController@show")->name('show');
        Route::post("/simpan-skor", "KuisController@simpanSkor")->name('simpanSkor');
    });


});

//route for progress update
Route::middleware('auth')->post('/progress/update', [MateriProgressController::class, 'update'])
    ->name('progress.update');

//route for attachments
Route::post('/attachment/upload', [App\Http\Controllers\AttachmentController::class, 'upload'])->name('attachment.upload');



