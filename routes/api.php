<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ItineraryController;
use App\Http\Controllers\Api\AuthController;



Route::get('/itineraries/popular' , [ItineraryController::class , 'popular']);


Route::middleware('auth:sanctum')->group(function () {
    
    Route::get('/itineraries' , [ItineraryController::class , 'index']);
    Route::post('/itineraries' ,[ItineraryController::class , 'store']);
    Route::put('/itineraries/{id}' ,[ItineraryController::class , 'update']);
    Route::delete('/itineraries/{id}' ,[ItineraryController::class , 'destroy']);
    Route::get('/itineraries/{id}' ,[ItineraryController::class , 'show']);

    Route::post('/itineraries/{id}/favorite' , [ItineraryController::class , 'favorite']);
});

Route::get('/itineraries/stats/categories' , [ItineraryController::class , 'categoryStats']);
Route::get('/users/stats/registrations' , [AuthController::class , 'userStats']);

Route::post('/register' , [AuthController::class , 'register']);
Route::post('/login' , [AuthController::class , 'login']);