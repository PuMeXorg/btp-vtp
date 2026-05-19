@extends('layouts.app')
@section('title', $item->title)
@section('content')
<div class="container mx-auto max-w-4xl px-4 py-12">
    <nav class="text-sm text-gray-400 mb-6">
        <a href="{{ route('home') }}" class="hover:text-primary">Главная</a>
        <span class="mx-2">/</span>
        <a href="{{ route('portfolio') }}" class="hover:text-primary">Портфолио</a>
        <span class="mx-2">/</span><span class="text-gray-600">{{ $item->title }}</span>
    </nav>
    <h1 class="text-3xl font-bold mb-6">{{ $item->title }}</h1>
    @if($item->image)
    <img src="{{ str_starts_with($item->image, '/') || str_starts_with($item->image, 'http') ? $item->image : asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-full rounded-xl mb-8 max-h-96 object-cover">
    @endif
    <div class="prose prose-lg max-w-none text-gray-700">{!! $item->content !!}</div>
    <div class="mt-10">
        <a href="{{ route('portfolio') }}" class="text-primary hover:underline">← Все проекты</a>
    </div>
</div>
@endsection
