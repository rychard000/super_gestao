<?php

use App\Fornecedor;
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

Route::post('teste', function(Request $request){
    return $request->name;
});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
