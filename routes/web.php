<?php

use App\Http\Controllers\Admin\ContactRequestController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FleetController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:5,1')->name('contact.store');
Route::middleware('guest')->group(function (): void { Route::get('/login',[AuthenticatedSessionController::class,'create'])->name('login'); Route::post('/login',[AuthenticatedSessionController::class,'store'])->middleware('throttle:5,1'); });
Route::post('/logout',[AuthenticatedSessionController::class,'destroy'])->middleware('auth')->name('logout');
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function (): void {
    Route::get('/',DashboardController::class)->name('dashboard');
    Route::resource('services',ServiceController::class)->except('show');
    Route::resource('fleet',FleetController::class)->except('show')->parameters(['fleet'=>'fleet']);
    Route::resource('partners',PartnerController::class)->except('show');
    Route::get('contact-requests',[ContactRequestController::class,'index'])->name('contacts.index');
    Route::get('contact-requests/{contact}',[ContactRequestController::class,'show'])->name('contacts.show');
    Route::patch('contact-requests/{contact}',[ContactRequestController::class,'update'])->name('contacts.update');
    Route::get('settings',[SettingController::class,'edit'])->name('settings.edit');
    Route::put('settings',[SettingController::class,'update'])->name('settings.update');
});
