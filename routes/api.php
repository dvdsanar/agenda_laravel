<?php

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

Route::get('/contacts', function()
{
    return 'Get All Contacts';
});

Route::get('/contact/{id}', function($id)
{
    return 'Get All Contacts By ID: '. $id;
});

Route::post('/contact', function(Request $request)
{
    dump($request->all());
    return 'You create a new contact';
});

Route::put('/contact/{id}', function($id)
{
    return 'You update contact: '. $id;
});

Route::delete('/contact/{id}', function($id)
{
    return 'You delete contact: '. $id;
});
