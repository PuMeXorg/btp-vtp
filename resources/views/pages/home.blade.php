@extends('layouts.app')

@section('title', 'Проектирование и монтаж тепловых пунктов под ключ')
@section('description', 'Монтаж ИТП, ЦТП и УУТЭ. Сдача в ПАО МОЭК и МТУ Ростехнадзора.')

@section('content')

@php
    $blocksByType = $blocks->keyBy('type');

    $hero = $blocksByType->get('hero');
    $cta = $blocksByType->get('cta');
    $advantagesBlock = $blocksByType->get('advantages');
    $processBlock = $blocksByType->get('process');
@endphp

{{-- HERO --}}
<section class="relative min-h-[620px] flex items-center overflow-hidden bg-gray-900">
    <div class="absolute inset-0">
        @if($hero?->image)
            <img src="{{ asset('storage/' . $hero->image) }}"
                 alt="{{ $hero->title }}"
                 class="w-full h-full object-cover opacity-45">
        @else
            <div class="w-full h-full bg-gradient-to-br from-gray-900 via-slate-800 to-primary opacity-90"></div>
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
                {!! nl2br(e($hero?->title ?: 'Монтаж тепловых пунктов под ключ от 40 дней')) !!}
            </h1>

            <p class="text-xl text-gray-300 mb-8 leading-relaxed">
                {!! nl2br(e($hero?->subtitle ?: 'Проектирование, монтаж и сдача ИТП, ЦТП и УУТЭ в ПАО «МОЭК» и МТУ Ростехнадзора.')) !!}
            </p>

            <div class="flex flex-wrap gap-4">
                <a href="{{ $hero?->button_url ?: route('contacts') }}"
                   class="inline-flex items-center gap-2 bg-primary hover:bg-primary-dark text-white px-8 py-4 rounded-xl font-bold text-lg transition shadow-lg">
                    {{ $hero?->button_text ?: 'Получить расчёт бесплатно' }}
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

                <a href="{{ route('portfolio') }}"
                   class="border-2 border-white/30 text-white hover:border-white hover:bg-white/10 px-8 py-4 rounded-xl font-bold text-lg transition inline-flex items-center gap-2">
                    <i class="fa-solid fa-eye"></i>
                    Наши проекты
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ПРЕИМУЩЕСТВА --}}
<section class="py-6 bg-primary">
    <div class="container mx-auto max-w-7xl px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-white">
            @foreach([
                ['icon' => 'fa-certificate', 'title' => 'Сдача в МОЭК', 'desc' => 'и МТУ Ростехнадзора'],
                ['icon' => 'fa-bolt', 'title' => 'Ускоренное', 'desc' => 'согласование проектов'],
                ['icon' => 'fa-industry', 'title' => 'Собственное', 'desc' => 'производство щитов'],
                ['icon' => 'fa-handshake', 'title' => 'Дилеры', 'desc' => 'ведущих производителей'],
            ] as $item)
                <div class="flex items-center gap-3 py-3">
                    <div class="w-10 h-10 rounded-xl bg-white/15 flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid {{ $item['icon'] }} text-white"></i>
                    </div>
                    <div>
                        <div class="font-bold text-sm">{{ $item['title'] }}</div>
                        <div class="text-blue-100 text-xs">{{ $item['desc'] }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- HTML-блок преимуществ из админки --}}
@if($advantagesBlock && ($advantagesBlock->settings['custom_html'] ?? null))
<section class="py-16 bg-white">
    <div class="container mx-auto max-w-7xl px-4">
        {!! $advantagesBlock->settings['custom_html'] !!}
    </div>
</section>
@endif

{{-- УСЛУГИ --}}
@if($services->count())
<section class="py-20 bg-gray-50">
    <div class="container mx-auto max-w-7xl px-4">
        <div class="text-center mb-14">
            <span class="text-primary font-semibold text-sm uppercase tracking-widest">Что мы делаем</span>
            <h2 class="text-4xl font-bold mt-2 mb-4">Наши услуги</h2>
            <p class="text-gray-500 max-w-2xl mx-auto">
                Полный цикл работ — от проектирования до сдачи объекта в эксплуатацию
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($services as $i => $service)
                <a href="{{ route('service', $service->slug) }}"
                   class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 hover:border-primary/30 hover:-translate-y-1">
                    <div class="relative h-48 overflow-hidden bg-gradient-to-br from-blue-50 to-blue-100">
                        @if($service->image)
                            <img src="{{ str_starts_with($service->image, 'http') ? $service->image : asset('storage/' . $service->image) }}"
                                 alt="{{ $service->title }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <i class="fa-solid fa-gears text-primary/30 text-6xl"></i>
                            </div>
                        @endif

                        <div class="absolute top-4 left-4">
                            <span class="bg-primary text-white text-xs font-bold px-3 py-1 rounded-full">
                                {{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}
                            </span>
                        </div>
                    </div>

                    <div class="p-6">
                        <h3 class="font-bold text-lg mb-2 group-hover:text-primary transition leading-snug">
                            {{ $service->title }}
                        </h3>

                        @if($service->excerpt)
                            <p class="text-gray-500 text-sm leading-relaxed">
                                {{ $service->excerpt }}
                            </p>
                        @endif

                        <div class="mt-4 flex items-center text-primary text-sm font-semibold">
                            Подробнее
                            <i class="fa-solid fa-arrow-right ml-2 group-hover:translate-x-1 transition"></i>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="text-center mt-10">
            <a href="{{ route('services') }}"
               class="inline-flex items-center gap-2 bg-primary hover:bg-primary-dark text-white px-8 py-3.5 rounded-xl font-semibold transition shadow-md">
                Все услуги
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
@endif

{{-- КАК МЫ РАБОТАЕМ --}}
<section class="py-20 bg-white">
    <div class="container mx-auto max-w-7xl px-4">
        <div class="text-center mb-14">
            <span class="text-primary font-semibold text-sm uppercase tracking-widest">Процесс</span>
            <h2 class="text-4xl font-bold mt-2 mb-4">
                {{ $processBlock?->title ?: 'Как мы работаем' }}
            </h2>
            <p class="text-gray-500">
                {{ $processBlock?->subtitle ?: 'От заявки до сдачи объекта — полный контроль на каждом этапе' }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
                ['step' => '01', 'icon' => 'fa-file-lines', 'title' => 'Заявка и расчёт', 'desc' => 'Оставьте заявку — специалист свяжется с вами и сделает предварительный расчёт.'],
                ['step' => '02', 'icon' => 'fa-drafting-compass', 'title' => 'Проектирование', 'desc' => 'Разрабатываем проектную документацию и согласовываем её в ПАО «МОЭК».'],
                ['step' => '03', 'icon' => 'fa-gears', 'title' => 'Монтаж', 'desc' => 'Выполняем монтаж оборудования собственными силами с контролем качества.'],
                ['step' => '04', 'icon' => 'fa-circle-check', 'title' => 'Сдача объекта', 'desc' => 'Сдаём объект в ПАО «МОЭК» и МТУ Ростехнадзора.'],
            ] as $step)
                <div class="relative text-center bg-gray-50 rounded-2xl p-6 border border-gray-100 hover:shadow-lg transition">
                    <div class="w-20 h-20 bg-primary/10 rounded-2xl flex items-center justify-center mx-auto mb-4 relative">
                        <i class="fa-solid {{ $step['icon'] }} text-primary text-2xl"></i>
                        <span class="absolute -top-2 -right-2 w-7 h-7 bg-primary text-white text-xs font-bold rounded-full flex items-center justify-center">
                            {{ $step['step'] }}
                        </span>
                    </div>

                    <h3 class="font-bold text-lg mb-2">{{ $step['title'] }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">{{ $step['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-20 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-primary to-blue-800"></div>

    <div class="container mx-auto max-w-7xl px-4 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="text-white">
                <h2 class="text-4xl font-bold mb-4">
                    {{ $cta?->title ?: 'Получите бесплатный расчёт стоимости' }}
                </h2>

                <p class="text-blue-100 text-lg mb-8 leading-relaxed">
                    {{ $cta?->subtitle ?: 'Оставьте заявку прямо сейчас, и наш инженер подготовит коммерческое предложение под ваш объект.' }}
                </p>

                <div class="space-y-4">
                    @foreach([
                        'Выезд специалиста на объект',
                        'Ускоренное согласование в ПАО МОЭК',
                        'Гарантия на все виды работ',
                        'Работаем по всей России',
                    ] as $benefit)
                        <div class="flex items-center gap-3">
                            <div class="w-6 h-6 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-check text-white text-xs"></i>
                            </div>
                            <span class="text-blue-100">{{ $benefit }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-white rounded-2xl p-8 shadow-2xl">
                <h3 class="text-xl font-bold mb-1">Оставить заявку</h3>
                <p class="text-gray-500 text-sm mb-6">Ответим в течение 15 минут в рабочее время</p>

                <form id="ctaForm" action="{{ route('lead.order') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="source_url" value="{{ url()->current() }}">

                    <input type="text" name="name" required placeholder="Ваше имя"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">

                    <input type="tel" name="phone" required placeholder="Телефон"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">

                    <input type="email" name="email" placeholder="Email"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">

                    <textarea name="comment" rows="3" placeholder="Описание объекта"
                              class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary resize-none"></textarea>

                    <button type="button" onclick="submitForm('ctaForm','{{ route('lead.order') }}','cta-success')"
                            class="w-full bg-primary hover:bg-primary-dark text-white py-4 rounded-xl font-bold text-lg transition shadow-lg">
                        {{ $cta?->button_text ?: 'Получить расчёт бесплатно' }}
                    </button>
                </form>

                <div id="cta-success" class="hidden text-center py-8">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-check text-green-500 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Заявка принята!</h3>
                    <p class="text-gray-500">Наш специалист свяжется с вами в ближайшее время</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ПОРТФОЛИО --}}
@if($portfolio->count())
<section class="py-20 bg-gray-50">
    <div class="container mx-auto max-w-7xl px-4">
        <div class="flex items-end justify-between mb-14">
            <div>
                <span class="text-primary font-semibold text-sm uppercase tracking-widest">Наши работы</span>
                <h2 class="text-4xl font-bold mt-2">Выполненные проекты</h2>
            </div>

            <a href="{{ route('portfolio') }}" class="hidden md:flex items-center gap-2 text-primary font-semibold">
                Все проекты
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($portfolio as $item)
                <a href="{{ route('portfolio.item', $item->slug) }}"
                   class="group relative rounded-2xl overflow-hidden aspect-[4/3] bg-gray-200 shadow-sm hover:shadow-xl transition-all duration-300">
                    @if($item->image)
                        <img src="{{ str_starts_with($item->image, 'http') ? $item->image : asset('storage/' . $item->image) }}"
                             alt="{{ $item->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-100 to-blue-200">
                            <i class="fa-solid fa-building text-primary/30 text-6xl"></i>
                        </div>
                    @endif

                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/20 to-transparent opacity-0 group-hover:opacity-100 transition"></div>

                    <div class="absolute bottom-0 left-0 right-0 p-5 translate-y-4 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 transition">
                        @if($item->category)
                            <span class="text-blue-300 text-xs font-semibold uppercase tracking-wider">
                                {{ $item->category }}
                            </span>
                        @endif

                        <h3 class="text-white font-bold mt-1">{{ $item->title }}</h3>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ДОПОЛНИТЕЛЬНЫЕ HTML-БЛОКИ ИЗ АДМИНКИ --}}
@foreach($blocks->where('type', 'html') as $htmlBlock)
<section class="py-16 bg-white">
    <div class="container mx-auto max-w-7xl px-4">
        @if($htmlBlock->title)
            <h2 class="text-3xl font-bold mb-6">{{ $htmlBlock->title }}</h2>
        @endif

        {!! $htmlBlock->settings['custom_html'] ?? $htmlBlock->content !!}
    </div>
</section>
@endforeach

@endsection
