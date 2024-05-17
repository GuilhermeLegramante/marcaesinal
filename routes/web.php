<?php

use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

Livewire::setScriptRoute(function ($handle) {
    return Route::get('/marcaesinal/public/livewire/livewire.js', $handle);
});

Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/marcaesinal/public/livewire/update', $handle);
});

Route::get('/', function () {
    return redirect('/admin/login');
});