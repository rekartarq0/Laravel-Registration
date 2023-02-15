<?php

use App\Http\Controllers\API\Auth\Logincontroller;
use App\Http\Controllers\ProductController;
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

Route::post('/register',[Loginontroller::class,'register']);
Route::post('/login',[Logincontroller::class,'sigin']);

Route::middleware(['auth:api'])->group(
    function(){
        Route::post('logout', [Logincontroller::class,'logout']);
        Route::middleware(['isAdmin'])->group(
            function(){
                Route::get('admin/users',[ProductController::class,'index']);
                Route::post('admin/users/create',[ProductController::class,'store']);
            }
        );
    }
);