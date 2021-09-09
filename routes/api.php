<?php

use App\Http\Controllers\ProjectController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('projects', 'App\Http\Controllers\ProjectController@index');
Route::get('project/{id}', 'App\Http\Controllers\ProjectController@show');
Route::post('addProject', 'App\Http\Controllers\ProjectController@store');
Route::put('updateProject/{id}', 'App\Http\Controllers\ProjectController@update');
Route::delete('deleteProject/{id}', 'App\Http\Controllers\ProjectController@destroy');
