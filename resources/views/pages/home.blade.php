@extends('layouts.app')

@section('title', 'Проектирование и монтаж тепловых пунктов под ключ')
@section('description', 'Монтаж ИТП, ЦТП и УУТЭ. Сдача в ПАО МОЭК и МТУ Ростехнадзора.')

@section('content')

@forelse($blocks as $block)

    @if($block->type === 'hero')
        <section class="relative min-h-[620px] flex items-center overflow-hidden bg-gray-900">
            <div class="absolute inset-0">
                @if($block->image)
                    <img src="{{ asset('storage/' . $block->image) }}"
                         alt="{{ $block->title }}"
                         class="w-full h-full object-cover opacity-45">
                @endif
                <div class="absolute inset-0 bg-gradient-to-r from-gray-900 via-gray-900/80 to-transparent"></div>
            </div>

            <div class="container mx-auto max-w-7xl px-4 relative z-10 py-20">
                <div class="max-w-3xl">
                    <div class="inline-flex items-center gap-2 bg-primary/20 border border-primary/40 text-blue-200 rounded-full px-4 py-1.5 text-sm font-medium mb-6">
                        <i class="fa-solid fa-circle-check text-primary"></i>
                        Более 500 объектов сдано в эксплуатацию
                    </div>

                    <h1 class="text-4xl md:text-6xl font-bold text-white leading-tight mb-6">
                        {!! nl2br(e($block->title)) !!}
                    </h1>

                    @if($block->subtitle)
                        <p class="text-xl text-gray-300 mb-8 leading-relaxed">
                            {!! nl2br(e($block->subtitle)) !!}
                        </p>
                    @endif

                    @if($block->button_text)
                        <a href="{{ $block->button_url ?: route('contacts') }}"
                           class="inline-flex items-center gap-2 bg-primary hover:bg-primary-dark text-white px-8 py-4 rounded-xl font-bold text-lg transition shadow-lg">
                            {{ $block->button_text }}
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    @endif
                </div>
            </div>
        </section>
    @endif

    @if($block->type === 'html')
        <section class="py-16">
            <div class="container mx-auto max-w-7xl px-4">
                {!! $block->settings['custom_html'] ?? $block->content !!}
            </div>
        </section>
    @endif

    @if($block->type === 'cta')
        <section class="py-20 bg-primary text-white">
            <div class="container mx-auto max-w-7xl px-4 text-center">
                <h2 class="text-4xl font-bold mb-4">{{ $block->title }}</h2>

                @if($block->subtitle)
                    <p class="text-blue-100 text-lg mb-8 max-w-2xl mx-auto">
                        {{ $block->subtitle }}
                    </p>
                @endif

                @if($block->button_text)
                    <a href="{{ $block->button_url ?: route('contacts') }}"
                       class="inline-flex items-center gap-2 bg-white text-primary hover:bg-blue-50 px-8 py-4 rounded-xl font-bold transition">
                        {{ $block->button_text }}
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                @endif
            </div>
        </section>
    @endif

@empty
    <section class="py-20">
        <div class="container mx-auto max-w-7xl px-4 text-center">
            <h1 class="text-3xl font-bold">Главная страница пока не настроена</h1>
            <p class="text-gray-500 mt-2">
                Добавьте блоки в админке: Главная страница → Конструктор главной.
            </p>
        </div>
    </section>
@endforelse

@endsection
