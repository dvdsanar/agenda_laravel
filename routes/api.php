<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::group([
    'middleware' => 'jwt.auth'
], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
});

//Contacts

Route::group([
    'middleware' => ['jwt.auth', 'isUserActive'], 
], function(){
    Route::get('/contacts', [ContactController::class, 'getAllContacts']);
    Route::get('/contact/{id}', [ContactController::class, 'getContactById']);
    Route::post('/contact', [ContactController::class, 'postContact']);
    Route::put('/contact/{id}', [ContactController::class, 'putContact']);
    Route::delete('/contact/{id}', [ContactController::class, 'deleteContact']);
});

//Users

Route::group([
    'middleware' => 'jwt.auth'
], function () {
    Route::get('/user-by-contact-id/{id}', [UserController::class, 'getUserByContactId']);
});


Route::group([
    'middleware' => 'isSuperAdmin'
], function () {
    Route::post('/create-user-admin/{id}', [UserController::class, 'createUserAdmin']);
    Route::post('/destroy-user-admin/{id}', [UserController::class, 'destroyUserAdmin']);
});