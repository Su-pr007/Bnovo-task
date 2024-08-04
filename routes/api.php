<?php

use App\Http\Controllers\GuestsController;
use Illuminate\Support\Facades\Route;

Route::resource('guests', GuestsController::class, [
    'except' => ['create', 'edit']
]);
