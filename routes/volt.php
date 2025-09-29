<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware(['auth'])->group(function () {
    Route::redirect('volt', 'volt/roles');
    Volt::route('volt/roles', 'volt.roles')->name('volt.roles');
});
