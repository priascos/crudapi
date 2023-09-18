<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ResearchersController;

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

Route::prefix('orcid')->group(function () {
    // return $request->user();
    Route::get('/list',[ResearchersController::class, 'list']);
    Route::post('/create',[ResearchersController::class, 'create']);
    Route::delete('/delete/{orcid}',[ResearchersController::class, 'delete']);
    Route::get('/{orcid}',[ResearchersController::class, 'detail']);
    // Route::put('/{orcid}',[ ResearchersController::class, 'update']);
});

