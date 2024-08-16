<?php

use App\Http\Controllers\api\readNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('readNotification',readNotification::class);