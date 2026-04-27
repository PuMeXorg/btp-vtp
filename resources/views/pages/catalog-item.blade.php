@extends('layouts.app')
@section('title', $page->title)
@section('content')
<div class="container mx-auto max-w-7xl px-4 py-12">
    <nav class="text-sm text-gray-400 mb-6">
        <a href="{{ route('home') }}" class="hover:text-primary">Главная</a>
        <span class="mx-2">/</span>
        <a href="{{ route('catalog') }}" class="hover:text-primary">Каталог</a>
        <span class="mx-2">/</span><span class="text-gray-600">{{ $page->title }}</span>
    </nav>
    <h1 class="text-3xl font-bold mb-8">{{ $page->title }}</h1>
    @if($page->image)
    <img src="{{ asset('storage/' . $page->image) }}" alt="{{ $page->title }}" class="w-full rounded-xl mb-8 max-h-96 object-cover">
    @endif
    <div class="prose prose-lg max-w-none text-gray-700">{!! $page->content !!}</div>
    @if($children->count())
    <h2 class="text-2xl font-bold mt-10 mb-5">Подразделы</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach($children as $child)
        <a href="{{ route('catalog.item', $child->slug) }}" class="border rounded-xl p-4 hover:border-primary hover:shadow-sm transition group">
            <h3 class="font-medium group-hover:text-primary transition">{{ $child->title }}</h3>
        </a>
        @endforeach
    </div>
    @endif
</div>
@endsection
