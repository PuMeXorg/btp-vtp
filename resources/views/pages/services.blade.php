@extends('layouts.app')
@section('title', 'Услуги')
@section('content')
<div class="container mx-auto max-w-7xl px-4 py-12">
    <nav class="text-sm text-gray-400 mb-6">
        <a href="{{ route('home') }}" class="hover:text-primary">Главная</a>
        <span class="mx-2">/</span>
        <span class="text-gray-600">Услуги</span>
    </nav>
    <h1 class="text-3xl font-bold mb-10">Наши услуги</h1>
    @if($services->count())
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($services as $service)
        <a href="{{ route('service', $service->slug) }}"
            class="group bg-white border rounded-xl overflow-hidden hover:shadow-lg transition">
            @if($service->image)
                <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}" class="w-full h-48 object-cover">
            @else
                <div class="w-full h-48 bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center text-5xl">⚙️</div>
            @endif
            <div class="p-5">
                <h2 class="font-bold text-lg mb-2 group-hover:text-primary transition">{{ $service->title }}</h2>
                @if($service->excerpt)<p class="text-gray-500 text-sm">{{ $service->excerpt }}</p>@endif
                <span class="inline-block mt-3 text-primary text-sm font-medium">Подробнее →</span>
            </div>
        </a>
        @endforeach
    </div>
    @else
    <p class="text-gray-400">Услуги скоро появятся</p>
    @endif
</div>
@endsection
