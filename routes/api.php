<?php

use Illuminate\Http\Request;
use App\Http\Controllers\StudentController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test', function () {
    return ['name'=>'shuvo', 'age'=>'28'];
});

Route::get('/data', [StudentController::class, 'index']);
Route::post('/store' , [StudentController::class, 'store']);
Route::get('/delete/{id}', [StudentController::class, 'delete']);
Route::post('/edit/{id}', [StudentController::class, 'edit'] );

//

Route::get('shuvo', [SignUpController::class, 'shuvo']);
