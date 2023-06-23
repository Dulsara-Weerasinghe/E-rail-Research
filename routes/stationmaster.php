<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Stationmaster\StationmasterController;


Route::prefix('stationmaster')->name('stationmaster.')->group(function(){

Route::middleware(['guest:stationmaster','PreventBackHistory'])->group(function(){
    Route::view('/login','dashboard.stationmaster.login')->name('login');
    Route::view('/register','dashboard.stationmaster.register')->name('register');
    Route::post('/create',[StationmasterController::class,'create'])->name('create');
    Route::post('/check',[StationmasterController::class,'check'])->name('check');
    Route::get('/verify',[StationmasterController::class,'verify'])->name('verify');
});

Route::middleware(['auth:stationmaster','PreventBackHistory'])->group(function(){
    Route::view('/home','dashboard.stationmaster.home')->name('home');
    Route::post('/logout',[StationmasterController::class,'logout'])->name('logout');


    Route::view('/etablet-request','dashboard.stationmaster.etablet-request')->name('etablet-request');
    Route::view('/etablet-approval','dashboard.stationmaster.etablet-approval')->name('etablet-approval');

});
});