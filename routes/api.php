<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
 use App\Http\Controllers\Api\CategoriesController;

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

// Route::middleware(['api','checkPassword'])->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware'=>['api','checkPassword','changeLanguage'],'namespace'=>'Api'],function(){
    
    Route::post('getCategories',[CategoriesController::class, 'index']);
     Route::post('getCategoryByID',[CategoriesController::class, 'showCatgeory']);

     Route::group(['prefix'=>'admin'],function(){
     Route::post('login',[AuthController::class,"login"]);
     Route::post('logout',[AuthController::class,"logout"])->middleware('auth.guard:admin-api');
     });
 
    

});
