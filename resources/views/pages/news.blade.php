@extends('layouts.app')
@section('title', 'Новости')
@section('content')
<div class="container mx-auto max-w-7xl px-4 py-12">
    <nav class="text-sm text-gray-400 mb-6">
        <a href="{{ route('home') }}" class="hover:text-primary">Главная</a>
        <span class="mx-2">/</span><span class="text-gray-600">Новости</span>
    </nav>
    <h1 class="text-3xl font-bold mb-10">Новости</h1>
    @if($news->count())
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($news as $item)
        <a href="{{ route('news.item', $item->slug) }}" class="group">
            @if($item->image)
                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-full h-48 object-cover rounded-xl mb-3">
            @else
                <div class="w-full h-48 bg-gray-100 rounded-xl mb-3 flex items-center justify-center text-4xl">📰</div>
            @endif
            <p class="text-gray-400 text-sm">{{ $item->published_at?->format('d.m.Y') }}</p>
            <h2 class="font-bold mt-1 group-hover:text-primary transition">{{ $item->title }}</h2>
            @if($item->excerpt)<p class="text-gray-500 text-sm mt-1">{{ $item->excerpt }}</p>@endif
        </a>
        @endforeach
    </div>
    <div class="mt-8">{{ $news->links() }}</div>
    @else
    <p class="text-gray-400">Новости скоро появятся</p>
    @endif
</div>
@endsection
