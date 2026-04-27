@extends('layouts.app')
@section('title', 'Портфолио')
@section('content')
<div class="container mx-auto max-w-7xl px-4 py-12">
    <nav class="text-sm text-gray-400 mb-6">
        <a href="{{ route('home') }}" class="hover:text-primary">Главная</a>
        <span class="mx-2">/</span><span class="text-gray-600">Портфолио</span>
    </nav>
    <h1 class="text-3xl font-bold mb-10">Портфолио</h1>
    @if($items->count())
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($items as $item)
        <a href="{{ route('portfolio.item', $item->slug) }}"
            class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition">
            @if($item->image)
                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-full h-52 object-cover group-hover:scale-105 transition duration-300">
            @else
                <div class="w-full h-52 bg-gray-100 flex items-center justify-center text-4xl">🏗️</div>
            @endif
            <div class="p-4">
                @if($item->category)
                <p class="text-xs text-primary font-medium mb-1">{{ $item->category }}</p>
                @endif
                <h2 class="font-medium group-hover:text-primary transition">{{ $item->title }}</h2>
            </div>
        </a>
        @endforeach
    </div>
    @else
    <p class="text-gray-400">Портфолио скоро появится</p>
    @endif
</div>
@endsection
