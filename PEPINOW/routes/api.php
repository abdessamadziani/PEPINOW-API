<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PlantController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;





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

Route::post('/register',[UserController::class,'register']);
Route::post('/login',[UserController::class,'login']);
// Route::post('/logout',[UserController::class,'logout']);
// Route::get('/showuser/{id}',[UserController::class,'show']);
// Route::get('/showusers',[UserController::class,'index']);
// route::get('/showplants',[PlantController::class,'index']);
// route::get('/showplant/{id}',[PlantController::class,'show']);
// route::post('/newplant',[PlantController::class,'store']);
// route::post('/updateplant/{id}',[PlantController::class,'update']);
// route::post('/remove/{id}',[PlantController::class,'destroy']);
// route::post('/newcat',[CategoryController::class,'store']);
// route::post('/update/{id}',[CategoryController::class,'update']);
// route::post('/delete/{id}',[CategoryController::class,'destroy']);


// route::post('/cat',function(){
//     return Category::create([
//         'category'=>'Tropicale'

//     ]);
// });


// route::post('/plant',function(){
//     return Plant::create([
//         'name'=>'titc',
//         'description'=>' desc Botanique',
//         'price'=>'33',
//         'image'=>'image.jpg',
//         'category_id'=>'1',
//         'user_id'=>'1',



//     ]);
// });







// Route::group(['middleware'=>['auth:sanctum']],function () {
//     Route::post('/logoutuser',[UserController::class,'logoutuser']);
//     Route::apiResource('showusers',UserController::class);
//     Route::post('/deleteuser/{id}',[UserController::class,'deleteuser']);
//     Route::post('/updateuser/{id}',[UserController::class,'updateuser']);
// });

Route::group(['middleware'=>['auth:sanctum']],function () {
    Route::post('/logout',[UserController::class,'logout']);
    Route::get('/showuser/{id}',[UserController::class,'show']);
    Route::get('/showusers',[UserController::class,'index']);
    Route::post('/updateuser/{id}',[UserController::class,'update']);
    Route::post('/deleteuser/{id}',[UserController::class,'destroy']);

    route::get('/showplants',[PlantController::class,'index']);
    route::get('/showplant/{id}',[PlantController::class,'show']);
    route::post('/newplant',[PlantController::class,'store']);
    route::post('/updateplant/{id}',[PlantController::class,'update']);
    route::post('/remove/{id}',[PlantController::class,'destroy']);
    route::post('/newcat',[CategoryController::class,'store']);
    route::post('/update/{id}',[CategoryController::class,'update']);
    route::post('/delete/{id}',[CategoryController::class,'destroy']);
    route::post('/changerole/{id}',[UserController::class,'changeRole']);
    route::get('/getcategories',[CategoryController::class,'index']);


});
