<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
 use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\User\AuthController as UserAuthController;


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
     Route::post('logout',[AuthController::class,"logout"])->middleware('auth.guard:admin_api');
     });

    Route::prefix('user')->group(function () {
    Route::post('login', [UserAuthController::class, 'userLogin']);
     Route::post('logout',[UserAuthController::class,"logout"])->middleware('auth.guard:user_api');
});
      Route::group(['prefix'=>'user' , 'middleware'=>'auth.guard:user_api','namespace'=>'User'],function(){
        
        Route::post('profile',function(){
            return "Only User Can Uthenticate";
        });

     });
 
    

});
