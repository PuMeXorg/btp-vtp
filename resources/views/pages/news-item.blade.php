@extends('layouts.app')
@section('title', $item->meta_title ?? $item->title)
@section('content')
<div class="container mx-auto max-w-4xl px-4 py-12">
    <nav class="text-sm text-gray-400 mb-6">
        <a href="{{ route('home') }}" class="hover:text-primary">Главная</a>
        <span class="mx-2">/</span>
        <a href="{{ route('news') }}" class="hover:text-primary">Новости</a>
        <span class="mx-2">/</span><span class="text-gray-600">{{ $item->title }}</span>
    </nav>
    <p class="text-gray-400 text-sm mb-3">{{ $item->published_at?->format('d.m.Y') }}</p>
    <h1 class="text-3xl font-bold mb-6">{{ $item->title }}</h1>
    @if($item->image)
    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-full rounded-xl mb-8 max-h-96 object-cover">
    @endif
    <div class="prose prose-lg max-w-none text-gray-700">{!! $item->content !!}</div>
    <div class="mt-10">
        <a href="{{ route('news') }}" class="text-primary hover:underline">← Все новости</a>
    </div>
</div>
@endsection
