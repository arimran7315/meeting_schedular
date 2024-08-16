<?php

use App\Http\Controllers\MeetingController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ValidUser;
use Illuminate\Support\Facades\Route;


Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::put('/updateImage', [UserController::class, 'updateImage'])->name('updateImage');
Route::put('/updatePassword', [UserController::class, 'updatePassword'])->name('updatePassword');
Route::put('/updateInformation', [UserController::class, 'updateInformation'])->name('updateInformation');

Route::resource('/meeting', MeetingController::class);

Route::resource('Notification', NotificationController::class);

Route::get('/',[UserController::class,'calender'])->name('index')->middleware(ValidUser::class);

Route::view('/login', 'login')->name('loginPage');

Route::get('/register', function () {
    return view('register');
})->name('registerPage');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');