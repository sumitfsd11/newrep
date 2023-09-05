<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\ImportExport;
use App\Http\Controllers\PictureController;
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
Route::post('/template',function(){
    return view('components.template-master');
});
Route::get('/', IndexController::class)->name('index');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/authenticate', [AuthController::class, 'authenticate'])
    ->name('authenticate');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('/surveys', SurveyController::class);
});

Route::resource('/answers', AnswerController::class);
Route::get('/results/{survey}', [ResultController::class, 'show'])
    ->name('results.show');

    Route::post('/import',[ImportExport::class,
            'import'])->name('import');
 Route::get('/export',[ImportExport::class,
            'export'])->name('export');

            Route::post('/upload',[ImportExport::class,
            'upload'])->name('upload');
            Route::post('/upload-picture',[PictureController::class,'store'])->name('upload_picture');