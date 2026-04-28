<?php

use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Illuminate\Support\Facades\Artisan;

/* NOTE: Do Not Remove
/ Livewire asset handling if using sub folder in domain
*/

Livewire::setUpdateRoute(function ($handle) {
    return Route::post(config('app.asset_prefix') . '/livewire/update', $handle);
});

Livewire::setScriptRoute(function ($handle) {
    return Route::get(config('app.asset_prefix') . '/livewire/livewire.js', $handle);
});
/*
/ END
*/
use App\Livewire\TrafficLightDisplay;

Route::get('/', TrafficLightDisplay::class);

Route::get('/migrate', function() {
    Artisan::call('migrate:refresh', ['--force' => true, '--seed' => true]);
    return 'Migrasi Refresh dan Seeding berhasil dieksekusi!';
});

Route::get('/clear-cache', function() {
    Artisan::call('view:clear');
    return 'View cache cleared! Silakan kembali ke halaman utama dan refresh.';
});

