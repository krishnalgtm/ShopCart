<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Apiscontroller;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\MemberController;
use App\Http\Middleware\AdminMiddleware;
use  App\Http\Middleware\UserMiddleware;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;



Route::post('singup', [ApiController::class ,'singup']);
Route::post('login', [ApiController::class ,'login']);


        
      

     
            
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('admin/users', [UserController::class, 'list']);
    Route::post('admin/add-user', [UserController::class, 'addUser']);
    Route::put('admin/update-user', [UserController::class, 'updateUser']);
    Route::delete('admin/delete-user/{id}', [UserController::class, 'deleteUser']);
    Route::get('admin/products', [ProductController::class, 'list']);
});

