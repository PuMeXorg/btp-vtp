<?php

use App\Http\Controllers\LeadController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegionController;
use Illuminate\Support\Facades\Route;

// Смена региона
Route::get('/region/set/{region}', [RegionController::class, 'setBySlug'])->name('region.set-link');
Route::post('/region/set', [RegionController::class, 'set'])->name('region.set');

// Заявки
Route::post('/lead/callback', [LeadController::class, 'callback'])->name('lead.callback');
Route::post('/lead/order', [LeadController::class, 'order'])->name('lead.order');

// Главная
Route::get('/', [PageController::class, 'home'])->name('home');

// О компании
Route::get('/o-kompanii', [PageController::class, 'about'])->name('about');
Route::get('/o-kompanii/sertifikaty', [PageController::class, 'certificates'])->name('certificates');
Route::get('/o-kompanii/rekvizity', [PageController::class, 'requisites'])->name('requisites');

// Услуги
Route::get('/uslugi', [PageController::class, 'services'])->name('services');
Route::get('/uslugi/{slug}', [PageController::class, 'service'])->name('service');

// Каталог
Route::get('/catalog', [PageController::class, 'catalog'])->name('catalog');
Route::get('/catalog/{slug}', [PageController::class, 'catalogItem'])->name('catalog.item');

// Остальные разделы
Route::get('/tseny', [PageController::class, 'prices'])->name('prices');
Route::get('/news', [PageController::class, 'news'])->name('news');
Route::get('/news/{slug}', [PageController::class, 'newsItem'])->name('news.item');
Route::get('/video', [PageController::class, 'videos'])->name('videos');
Route::get('/kontakty', [PageController::class, 'contacts'])->name('contacts');
Route::get('/portfolio', [PageController::class, 'portfolio'])->name('portfolio');
Route::get('/portfolio/{slug}', [PageController::class, 'portfolioItem'])->name('portfolio.item');
