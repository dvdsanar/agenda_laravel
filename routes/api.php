<?php

use App\Http\Controllers\ContactController;
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


//Contacts

Route::get('/contacts', [ContactController::class, 'getAllContacts']);
Route::get('/contact/{id}', [ContactController::class, 'getContactById']);
Route::post('/contact', [ContactController::class, 'postContact']);
Route::put('/contact/{id}', [ContactController::class, 'putContact']);
Route::delete('/contact/{id}', [ContactController::class, 'deleteContact']);
