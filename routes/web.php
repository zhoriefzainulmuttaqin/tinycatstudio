<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WebsiteController::class, 'home'])->name('home');
Route::get('/services/{service}', [WebsiteController::class, 'service'])->name('services.show');
Route::get('/portfolio', [WebsiteController::class, 'portfolios'])->name('portfolios.index');
Route::get('/portfolio/{portfolio}', [WebsiteController::class, 'portfolio'])->name('portfolios.show');
Route::get('/blog', [WebsiteController::class, 'blog'])->name('blog.index');
Route::get('/blog/{post}', [WebsiteController::class, 'post'])->name('blog.show');

Route::post('/leads', [LeadController::class, 'store'])->name('leads.store');
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
