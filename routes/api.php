<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CandidateController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
 
// // custom API route 
// Route::middleware('auth:api')->get('/user/get', [UserController::class, 'get']);

//Route::get('user', 'Auth\AuthController@user');
Route::group([
    'prefix' => 'auth'
], function () {
     Route::post('login', [AuthController::class, 'login'])->name('login');
     Route::post('register', [AuthController::class, 'register']);
    //  Route::get('user', 'Auth\AuthController@user');
    //  Route::get('/user', [AuthController::class, 'user']);
     Route::group([
        'middleware' => 'auth:api'
      ], function() {
          Route::get('logout', [AuthController::class, 'logout']);
          Route::get('user', [AuthController::class, 'user']);
   });
});

Route::group([
    'prefix' => 'candidate'
], function () {
     Route::group([
        'middleware' => 'auth:api'
      ], function() {
          Route::get('/', [CandidateController::class, 'all']);
          Route::get('/{id}', [CandidateController::class, 'get']);
          Route::post('/add', [CandidateController::class, 'add']);
          Route::put('/update/{id}', [CandidateController::class, 'update']);
          Route::delete('/delete/{id}', [CandidateController::class, 'delete']);
   });
});