@extends('layouts.app')
@section('title', $page->meta_title ?? $page->title)
@section('content')
<div class="container mx-auto max-w-7xl px-4 py-12">
    <nav class="text-sm text-gray-400 mb-6">
        <a href="{{ route('home') }}" class="hover:text-primary">Главная</a>
        <span class="mx-2">/</span>
        <a href="{{ route('services') }}" class="hover:text-primary">Услуги</a>
        @if($page->parent)
        <span class="mx-2">/</span>
        <a href="{{ route('service', $page->parent->slug) }}" class="hover:text-primary">{{ $page->parent->title }}</a>
        @endif
        <span class="mx-2">/</span>
        <span class="text-gray-600">{{ $page->title }}</span>
    </nav>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <div class="lg:col-span-2">
            <h1 class="text-3xl font-bold mb-6">{{ $page->title }}</h1>
            @if($page->image)
            <img src="{{ asset('storage/' . $page->image) }}" alt="{{ $page->title }}" class="w-full rounded-xl mb-6 max-h-96 object-cover">
            @endif
            <div class="prose prose-lg max-w-none text-gray-700">{!! $page->content !!}</div>
            @if($children->count())
            <h2 class="text-2xl font-bold mt-10 mb-5">Подразделы</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($children as $child)
                <a href="{{ route('service', $child->slug) }}"
                    class="border border-primary/20 bg-primary/5 backdrop-blur-sm rounded-xl p-4 hover:bg-primary/10 hover:border-primary/40 hover:shadow-md transition group flex gap-4 items-start">
                    @if($child->image)
                        <div class="w-20 h-20 rounded-lg overflow-hidden bg-white/60 flex-shrink-0">
                            <img src="{{ str_starts_with($child->image, '/') || str_starts_with($child->image, 'http') ? $child->image : asset('storage/' . $child->image) }}"
                                 alt="{{ $child->title }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        </div>
                    @endif
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-gray-900 group-hover:text-primary transition leading-snug">{{ $child->title }}</h3>
                        @if($child->excerpt)<p class="text-sm text-gray-600 mt-1">{{ $child->excerpt }}</p>@endif
                    </div>
                </a>
                @endforeach
            </div>
            @endif
        </div>
        <div>
            <div class="bg-primary text-white rounded-2xl p-6 sticky top-24">
                <h3 class="font-bold text-lg mb-3">Оставить заявку</h3>
                <p class="text-blue-100 text-sm mb-4">Получите консультацию по данной услуге</p>
                <form id="sideForm" action="{{ route('lead.order') }}" method="POST">
                    @csrf
                    <input type="hidden" name="source_url" value="{{ url()->current() }}">
                    <input type="hidden" name="comment" value="Интересует: {{ $page->title }}">
                    <div class="space-y-3">
                        <input type="text" name="name" placeholder="Ваше имя" required
                            class="w-full px-3 py-2 rounded-lg text-gray-900 text-sm focus:outline-none">
                        <input type="tel" name="phone" placeholder="Ваш телефон" required
                            class="w-full px-3 py-2 rounded-lg text-gray-900 text-sm focus:outline-none">
                        <button type="button"
                            onclick="submitForm('sideForm','{{ route('lead.order') }}','side-success')"
                            class="w-full bg-orange-500 hover:bg-orange-600 text-white py-2.5 rounded-lg font-medium transition">
                            Отправить заявку
                        </button>
                    </div>
                </form>
                <div id="side-success" class="hidden text-center py-4">
                    <div class="text-3xl mb-2">✓</div>
                    <p class="font-medium">Заявка принята!</p>
                </div>
                <div class="mt-5 pt-5 border-t border-white/20">
                    <a href="tel:{{ preg_replace('/[^+\d]/', '', $regionPhone) }}"
                        class="text-white font-bold text-lg block hover:underline">{{ $regionPhone }}</a>
                    <p class="text-blue-200 text-xs mt-1">{{ $regionHours }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
