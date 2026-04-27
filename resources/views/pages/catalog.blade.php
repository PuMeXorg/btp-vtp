@extends('layouts.app')
@section('title', 'Каталог')
@section('content')
<div class="container mx-auto max-w-7xl px-4 py-12">
    <nav class="text-sm text-gray-400 mb-6">
        <a href="{{ route('home') }}" class="hover:text-primary">Главная</a>
        <span class="mx-2">/</span><span class="text-gray-600">Каталог</span>
    </nav>
    <h1 class="text-3xl font-bold mb-10">Каталог</h1>
    @if($items->count())
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($items as $item)
        <a href="{{ route('catalog.item', $item->slug) }}"
            class="group bg-white border rounded-xl overflow-hidden hover:shadow-lg transition">
            @if($item->image)
                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-full h-48 object-cover">
            @else
                <div class="w-full h-48 bg-gray-100 flex items-center justify-center text-5xl">📦</div>
            @endif
            <div class="p-5">
                <h2 class="font-bold text-lg group-hover:text-primary transition">{{ $item->title }}</h2>
                @if($item->excerpt)<p class="text-gray-500 text-sm mt-1">{{ $item->excerpt }}</p>@endif
                <span class="inline-block mt-3 text-primary text-sm font-medium">Подробнее →</span>
            </div>
        </a>
        @endforeach
    </div>
    @else
    <p class="text-gray-400">Каталог скоро появится</p>
    @endif
</div>
@endsection
