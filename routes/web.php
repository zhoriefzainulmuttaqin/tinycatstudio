<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
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

Route::middleware('guest')->group(function (): void {
    Route::get('/masuk-kucing', [AdminAuthController::class, 'create'])->name('login');
    Route::post('/masuk-kucing', [AdminAuthController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function (): void {
    Route::get('/admin', DashboardController::class)->name('dashboard');
    Route::post('/admin/logout', [AdminAuthController::class, 'destroy'])->name('logout');
});

Route::post('/leads', [LeadController::class, 'store'])->name('leads.store');
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');

Route::get('/sitemap.xml', [WebsiteController::class, 'sitemap'])->name('sitemap');

Route::middleware([\Illuminate\Session\Middleware\StartSession::class])->group(function () {
    Route::get('/invoices/{invoice}/preview', [\App\Http\Controllers\InvoiceController::class, 'preview'])->name('invoices.preview');
    Route::get('/invoices/{invoice}/download', [\App\Http\Controllers\InvoiceController::class, 'download'])->name('invoices.download');
    Route::get('/pay/{invoice_number}', [\App\Http\Controllers\InvoiceController::class, 'publicView'])->name('invoices.public');
    Route::get('/pay/{invoice_number}/download', [\App\Http\Controllers\InvoiceController::class, 'publicDownload'])->name('invoices.public.download');
});
