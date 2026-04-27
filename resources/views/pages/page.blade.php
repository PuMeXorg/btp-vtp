@extends('layouts.app')

@section('title', $page->meta_title ?? $page->title)
@section('description', $page->meta_description ?? $page->excerpt ?? '')

@section('content')
<div class="container mx-auto max-w-7xl px-4 py-12">
    <nav class="text-sm text-gray-400 mb-6">
        <a href="{{ route('home') }}" class="hover:text-primary">Главная</a>
        @if($page->parent)
        <span class="mx-2">/</span>
        <a href="{{ $page->parent->url }}" class="hover:text-primary">{{ $page->parent->title }}</a>
        @endif
        <span class="mx-2">/</span>
        <span class="text-gray-600">{{ $page->title }}</span>
    </nav>

    <div class="max-w-4xl">
        <h1 class="text-3xl font-bold mb-8">{{ $page->title }}</h1>
        @if($page->image)
        <img src="{{ asset('storage/' . $page->image) }}"
            alt="{{ $page->title }}"
            class="w-full rounded-xl mb-8 max-h-96 object-cover">
        @endif
        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
            {!! $page->content !!}
        </div>
    </div>
</div>
@endsection
