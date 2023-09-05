<?php

use App\Http\Controllers\Api\AnswerController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\SurveyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', LoginController::class);
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', LogoutController::class);
    Route::apiResource('/surveys', SurveyController::class, [
        'as' => 'api',
    ]);
    Route::apiResource('/answers', AnswerController::class, [
        'as' => 'api',
    ]);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
