<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocalizationController;

Route::get('lang/{locale}', LocalizationController::class)
    ->name('lang.switcher');

Route::redirect('/', '/login');

Auth::routes();

Route::group(['middleware' => 'auth'], function ()
{
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('categories', App\Http\Controllers\CategoryController::class)
        ->only(['create', 'store', 'edit', 'update', 'destroy'])
        ->parameters([
            'categories' => 'category:slug',
        ]);
        
    Route::resource('articles', App\Http\Controllers\ArticleController::class)
        ->parameters([
            'articles' => 'article:slug',
        ]);
});
