<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ItineraryController;
use App\Http\Controllers\Api\AuthController;


Route::middleware('auth:sanctum')->group(function () {
    
    Route::get('/itineraries' , [ItineraryController::class , 'index']);
    Route::post('/itineraries' ,[ItineraryController::class , 'store']);
    Route::put('/itineraries/{id}' ,[ItineraryController::class , 'update']);
    Route::delete('/itineraries/{id}' ,[ItineraryController::class , 'destroy']);
    Route::get('/itineraries/{id}' ,[ItineraryController::class , 'show']);

    Route::post('/itineraries/{id}/favorite' , [ItineraryController::class , 'favorite']);
});

Route::post('/register' , [AuthController::class , 'register']);
Route::post('/login' , [AuthController::class , 'login']);