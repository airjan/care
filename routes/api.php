<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EventController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::group(['namespace' => 'Api', 'prefix' => 'v1'], function () {
  Route::post('login', [AuthController::class, 'login'])->name('api.login');
  Route::post('user/create', [AuthController::class, 'create'])->name('api.user.create');
  // secured endpoint
  Route::group(['middleware' => 'auth:api'], function (){
        Route::post('logout', [AuthController::class, 'logout'])->name('api.logout');
       // Route::post('event/create', [EventController::class, 'create'])->name('api.event.create');
        
        Route::group(['prefix' =>'event'], function(){
           
                Route::post('/create', [EventController::class, 'create'])->name('api.event.create');
                Route::get('/instance', [EventController::class, 'read'])->name('api.event.read');
            
        });
        
        /*  
        Route::controller(EventController::class)->group(function(){
            Route::group(['prefix' =>'event'], function(){
            
                Route::post('/create','create')->name('api.event.create');

            });
        });
        */
  });
  

});
