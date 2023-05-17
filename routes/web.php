<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController as C;

Route::prefix('admin/customers')->name('customers-')->group(function () {
    Route::get('/', [C::class, 'index'])->name('index');
    Route::get('/create', [C::class, 'create'])->name('create');
    Route::post('/create', [C::class, 'store'])->name('store');
    Route::get('/edit/{customer}', [C::class, 'edit'])->name('edit');
    Route::put('/edit/{customer}', [C::class, 'update'])->name('update');
    Route::get('/add/{customer}', [C::class, 'add'])->name('add');
    Route::put('/updateAdd/{customer}', [C::class, 'updateAdd'])->name('updateAdd');
    Route::get('/withdraw/{customer}', [C::class, 'withdraw'])->name('withdraw');
    Route::put('/updateWithdraw/{customer}', [C::class, 'updateWithdraw'])->name('updateWithdraw');
    Route::delete('/delete/{customer}', [C::class, 'destroy'])->name('delete');
});

Auth::routes(['register' => false]);

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');