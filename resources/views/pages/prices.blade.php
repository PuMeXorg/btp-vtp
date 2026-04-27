@extends('layouts.app')
@section('title', 'Цены')
@section('content')
<div class="container mx-auto max-w-7xl px-4 py-12">
    <nav class="text-sm text-gray-400 mb-6">
        <a href="{{ route('home') }}" class="hover:text-primary">Главная</a>
        <span class="mx-2">/</span><span class="text-gray-600">Цены</span>
    </nav>
    <h1 class="text-3xl font-bold mb-8">{{ $page->title }}</h1>
    <div class="prose prose-lg max-w-none text-gray-700">{!! $page->content !!}</div>
    <div class="mt-12 bg-primary text-white rounded-2xl p-8 text-center">
        <h2 class="text-2xl font-bold mb-3">Нужен точный расчёт?</h2>
        <p class="text-blue-100 mb-6">Оставьте заявку и мы подготовим индивидуальное предложение</p>
        <a href="{{ route('contacts') }}"
            class="bg-white text-primary hover:bg-blue-50 px-8 py-3 rounded-lg font-bold transition inline-block">
            Получить расчёт
        </a>
    </div>
</div>
@endsection
