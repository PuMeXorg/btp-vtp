@extends('layouts.app')

@section('title', 'Проектирование и поставка БТП, ИТП, ЦТП и насосных станций')
@section('description', 'ВТП Инжиниринг — проектирование, производство и поставка БТП, ИТП, ЦТП, насосных станций и систем автоматизации.')

@section('content')

@php
    $blocksByType = isset($blocks) ? $blocks->keyBy('type') : collect();

    $hero = $blocksByType->get('hero');
    $cta = $blocksByType->get('cta');
    $advantagesBlock = $blocksByType->get('advantages');
    $processBlock = $blocksByType->get('process');
@endphp

{{-- HERO --}}
<section class="relative overflow-hidden bg-gray-950 min-h-[720px] flex items-center">
    {{-- Фоновое изображение из админки --}}
    <div class="absolute inset-0">
        @if($hero?->image)
            <img
                src="{{ asset('storage/' . $hero->image) }}"
                alt="{{ $hero->title ?? 'ВТП Инжиниринг' }}"
                class="w-full h-full object-cover opacity-100"
            >

            {{-- Затемнение слева под текст + лёгкий красный оттенок справа --}}
            <div class="absolute inset-0 bg-gradient-to-r from-gray-950 via-gray-950/70 to-red-950/25"></div>
            <div class="absolute inset-0 bg-black/20"></div>
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-gray-950 via-gray-900 to-red-950"></div>
        @endif
    </div>

    {{-- Декор, но слабее, чтобы не забивал фото --}}
    <div class="absolute inset-0 opacity-15 pointer-events-none">
        <div class="absolute -top-32 -right-32 w-[520px] h-[520px] bg-red-600 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-[420px] h-[420px] bg-red-700 rounded-full blur-3xl"></div>
    </div>

    <div class="container mx-auto max-w-7xl px-4 relative z-10 py-20 lg:py-28">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <div class="inline-flex items-center gap-2 bg-red-500/15 border border-red-400/40 text-red-100 rounded-full px-4 py-2 text-sm font-semibold mb-6 backdrop-blur">
                    <i class="fa-solid fa-circle-check text-red-400"></i>
                    Инженерные решения для коммерческих и промышленных объектов
                </div>

                <h1 class="text-4xl md:text-6xl font-bold text-white leading-tight mb-6 drop-shadow-2xl">
                    {!! nl2br(e($hero?->title ?: 'БТП, ИТП, ЦТП и насосные станции под ваш объект')) !!}
                </h1>

                <p class="text-xl text-gray-100 mb-8 leading-relaxed max-w-2xl drop-shadow">
                    {!! nl2br(e($hero?->subtitle ?: 'Проектируем, производим и поставляем инженерное оборудование для управляющих компаний, застройщиков, подрядчиков, промышленных и коммерческих объектов.')) !!}
                </p>

                <div class="flex flex-wrap gap-4 mb-8">
                    <a href="{{ $hero?->button_url ?: route('contacts') }}"
                       class="inline-flex items-center justify-center gap-2 bg-primary hover:bg-primary-dark text-white px-8 py-4 rounded-xl font-bold text-lg transition shadow-xl shadow-red-900/30">
                        {{ $hero?->button_text ?: 'Оставить заявку' }}
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>

                    <a href="{{ route('prices') }}"
                       class="inline-flex items-center justify-center gap-2 border-2 border-white/35 text-white hover:border-white hover:bg-white/10 px-8 py-4 rounded-xl font-bold text-lg transition backdrop-blur">
                        <i class="fa-solid fa-calculator"></i>
                        Рассчитать стоимость
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 max-w-2xl">
                    <div class="bg-white/12 border border-white/15 rounded-2xl p-4 backdrop-blur">
                        <div class="text-3xl font-bold text-white">500+</div>
                        <div class="text-sm text-gray-200">объектов</div>
                    </div>
                    <div class="bg-white/12 border border-white/15 rounded-2xl p-4 backdrop-blur">
                        <div class="text-3xl font-bold text-white">15+</div>
                        <div class="text-sm text-gray-200">лет опыта</div>
                    </div>
                    <div class="bg-white/12 border border-white/15 rounded-2xl p-4 backdrop-blur">
                        <div class="text-3xl font-bold text-white">4</div>
                        <div class="text-sm text-gray-200">ключевых направления</div>
                    </div>
                </div>
            </div>

            <div class="relative">
                <div class="bg-white/10 border border-white/15 rounded-3xl p-6 lg:p-8 backdrop-blur-md shadow-2xl">
                    <div class="bg-white/95 rounded-2xl p-6 shadow-xl">
                        <div class="text-sm font-bold text-primary uppercase tracking-widest mb-3">
                            Основные направления
                        </div>

                        <div class="space-y-4">
                            <div class="flex items-start gap-4 p-4 rounded-2xl bg-gray-50 border border-gray-100">
                                <div class="w-11 h-11 rounded-xl bg-red-100 text-primary flex items-center justify-center flex-shrink-0">
                                    <i class="fa-solid fa-industry"></i>
                                </div>
                                <div>
                                    <div class="font-bold text-gray-900">БТП и тепловые пункты</div>
                                    <div class="text-sm text-gray-500">ИТП, ЦТП, блочные тепловые пункты</div>
                                </div>
                            </div>

                            <div class="flex items-start gap-4 p-4 rounded-2xl bg-gray-50 border border-gray-100">
                                <div class="w-11 h-11 rounded-xl bg-red-100 text-primary flex items-center justify-center flex-shrink-0">
                                    <i class="fa-solid fa-water"></i>
                                </div>
                                <div>
                                    <div class="font-bold text-gray-900">Насосные станции</div>
                                    <div class="text-sm text-gray-500">Повысительные, пожаротушения, канализационные</div>
                                </div>
                            </div>

                            <div class="flex items-start gap-4 p-4 rounded-2xl bg-gray-50 border border-gray-100">
                                <div class="w-11 h-11 rounded-xl bg-red-100 text-primary flex items-center justify-center flex-shrink-0">
                                    <i class="fa-solid fa-microchip"></i>
                                </div>
                                <div>
                                    <div class="font-bold text-gray-900">Автоматизация ИТП и ЦТП</div>
                                    <div class="text-sm text-gray-500">Текон, Овен, Данфос, Сигнетик и другие решения</div>
                                </div>
                            </div>

                            <div class="flex items-start gap-4 p-4 rounded-2xl bg-gray-50 border border-gray-100">
                                <div class="w-11 h-11 rounded-xl bg-red-100 text-primary flex items-center justify-center flex-shrink-0">
                                    <i class="fa-solid fa-pen-ruler"></i>
                                </div>
                                <div>
                                    <div class="font-bold text-gray-900">Проектирование</div>
                                    <div class="text-sm text-gray-500">Инженерные решения под параметры объекта</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ПРЕИМУЩЕСТВА --}}
<section class="py-6 bg-primary">
    <div class="container mx-auto max-w-7xl px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-white">
            @foreach([
                ['icon' => 'fa-building', 'title' => 'Для УК и застройщиков', 'desc' => 'решения под объект'],
                ['icon' => 'fa-industry', 'title' => 'Собственное производство', 'desc' => 'электрощитов и узлов'],
                ['icon' => 'fa-file-signature', 'title' => 'Проектирование', 'desc' => 'под требования заказчика'],
                ['icon' => 'fa-handshake', 'title' => 'Поставки', 'desc' => 'для подрядчиков и объектов'],
            ] as $item)
                <div class="flex items-center gap-3 py-3">
                    <div class="w-10 h-10 rounded-xl bg-white/15 flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid {{ $item['icon'] }} text-white"></i>
                    </div>
                    <div>
                        <div class="font-bold text-sm">{{ $item['title'] }}</div>
                        <div class="text-red-100 text-xs">{{ $item['desc'] }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- УСЛУГИ --}}
@if($services->count())
<section class="py-20 bg-gray-50">
    <div class="container mx-auto max-w-7xl px-4">
        <div class="text-center mb-14">
            <span class="text-primary font-semibold text-sm uppercase tracking-widest">Что мы делаем</span>
            <h2 class="text-4xl font-bold mt-2 mb-4">Основные направления</h2>
            <p class="text-gray-500 max-w-2xl mx-auto">
                Подбираем инженерное решение под задачи объекта, бюджет и технические требования.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($services as $i => $service)
                <a href="{{ route('service', $service->slug) }}"
                   class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 hover:border-primary/30 hover:-translate-y-1">
                    <div class="relative h-48 overflow-hidden bg-gradient-to-br from-red-50 to-gray-100">
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

{{-- ДЛЯ КОГО --}}
<section class="py-20 bg-white">
    <div class="container mx-auto max-w-7xl px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <span class="text-primary font-semibold text-sm uppercase tracking-widest">Кому подходим</span>
                <h2 class="text-4xl font-bold mt-2 mb-6">Работаем с объектами, где важны сроки, надёжность и понятная смета</h2>
                <p class="text-gray-500 text-lg leading-relaxed mb-8">
                    ВТП Инжиниринг помогает заказчикам подобрать и реализовать инженерное решение под конкретный объект — без лишних согласований и непонятных технических формулировок.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach([
                        'Управляющие компании',
                        'Застройщики',
                        'Подрядчики',
                        'Промышленные объекты',
                        'Коммерческая недвижимость',
                        'Госзаказчики и тендеры',
                    ] as $target)
                        <div class="flex items-center gap-3 bg-gray-50 border border-gray-100 rounded-xl p-4">
                            <div class="w-8 h-8 rounded-full bg-red-100 text-primary flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-check text-sm"></i>
                            </div>
                            <div class="font-semibold text-gray-800">{{ $target }}</div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-gray-50 rounded-3xl p-8 border border-gray-100">
                <h3 class="text-2xl font-bold mb-6">Что показываем в проектах</h3>

                <div class="space-y-4">
                    @foreach([
                        ['title' => 'Что сделали', 'desc' => 'Какое оборудование или инженерное решение было реализовано.'],
                        ['title' => 'Для кого', 'desc' => 'Тип заказчика: УК, застройщик, подрядчик, производство или коммерческий объект.'],
                        ['title' => 'Где', 'desc' => 'Город, объект или направление поставки.'],
                        ['title' => 'Какой результат', 'desc' => 'Что получил заказчик: поставку, проект, автоматизацию или готовое решение.'],
                    ] as $item)
                        <div class="flex gap-4 bg-white rounded-2xl p-5 shadow-sm">
                            <div class="w-10 h-10 rounded-xl bg-primary text-white flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-arrow-right"></i>
                            </div>
                            <div>
                                <div class="font-bold text-gray-900">{{ $item['title'] }}</div>
                                <div class="text-sm text-gray-500 mt-1">{{ $item['desc'] }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ПЕРЕХОД НА КАЛЬКУЛЯТОР --}}
<section class="py-20 bg-gray-950 relative overflow-hidden">
    <div class="absolute inset-0 opacity-40">
        <div class="absolute top-0 right-0 w-[420px] h-[420px] bg-red-700 rounded-full blur-3xl"></div>
    </div>

    <div class="container mx-auto max-w-7xl px-4 relative z-10">
        <div class="bg-gradient-to-br from-gray-900 via-gray-900 to-red-950 border border-white/10 rounded-3xl p-8 md:p-12">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
                <div>
                    <span class="text-red-300 font-semibold text-sm uppercase tracking-widest">Расчёт стоимости</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-white mt-3 mb-4">
                        Подберите решение под ваш объект
                    </h2>
                    <p class="text-gray-300 text-lg leading-relaxed">
                        Заполните параметры на странице цен — инженер изучит вводные и подготовит предварительный расчёт.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row lg:justify-end gap-4">
                    <a href="{{ route('prices') }}"
                       class="inline-flex items-center justify-center gap-2 bg-primary hover:bg-primary-dark text-white px-8 py-4 rounded-xl font-bold transition shadow-xl">
                        Рассчитать стоимость
                        <i class="fa-solid fa-calculator"></i>
                    </a>

                    <a href="tel:{{ preg_replace('/[^+\d]/', '', $regionPhone) }}"
                       class="inline-flex items-center justify-center gap-2 border-2 border-white/25 text-white hover:bg-white/10 px-8 py-4 rounded-xl font-bold transition">
                        <i class="fa-solid fa-phone"></i>
                        Позвонить
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ПРОЦЕСС --}}
<section class="py-20 bg-white">
    <div class="container mx-auto max-w-7xl px-4">
        <div class="text-center mb-14">
            <span class="text-primary font-semibold text-sm uppercase tracking-widest">Как работаем</span>
            <h2 class="text-4xl font-bold mt-2 mb-4">
                {{ $processBlock?->title ?: 'От заявки до готового решения' }}
            </h2>
            <p class="text-gray-500">
                {{ $processBlock?->subtitle ?: 'Помогаем пройти путь от первичных вводных до понятного технического и коммерческого предложения.' }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
                ['step' => '01', 'icon' => 'fa-phone', 'title' => 'Заявка', 'desc' => 'Вы оставляете заявку или звоните — уточняем задачу и тип объекта.'],
                ['step' => '02', 'icon' => 'fa-list-check', 'title' => 'Сбор вводных', 'desc' => 'Фиксируем параметры, назначение объекта, требования и ограничения.'],
                ['step' => '03', 'icon' => 'fa-calculator', 'title' => 'Расчёт', 'desc' => 'Подбираем техническое решение и готовим предварительную оценку.'],
                ['step' => '04', 'icon' => 'fa-file-signature', 'title' => 'Предложение', 'desc' => 'Передаём коммерческое предложение и обсуждаем дальнейшие шаги.'],
            ] as $step)
                <div class="relative text-center bg-gray-50 rounded-2xl p-6 border border-gray-100 hover:shadow-lg transition">
                    <div class="w-20 h-20 bg-red-100 rounded-2xl flex items-center justify-center mx-auto mb-4 relative">
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

{{-- ОТЗЫВЫ --}}
<section class="py-20 bg-gray-50">
    <div class="container mx-auto max-w-7xl px-4">
        <div class="text-center mb-14">
            <span class="text-primary font-semibold text-sm uppercase tracking-widest">Отзывы</span>
            <h2 class="text-4xl font-bold mt-2 mb-4">Что ценят заказчики</h2>
            <p class="text-gray-500 max-w-2xl mx-auto">
                Можно заменить эти отзывы на реальные письма, благодарности или короткие комментарии клиентов.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach([
                ['name' => 'Управляющая компания', 'text' => 'Получили понятное техническое предложение и быстро согласовали параметры оборудования под объект.'],
                ['name' => 'Подрядная организация', 'text' => 'Команда помогла подобрать решение и оперативно подготовила информацию для расчёта бюджета.'],
                ['name' => 'Коммерческий объект', 'text' => 'Понравился системный подход: сначала разобрали задачу, потом предложили несколько вариантов решения.'],
            ] as $review)
                <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
                    <div class="flex gap-1 text-primary mb-4">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <p class="text-gray-600 leading-relaxed mb-5">“{{ $review['text'] }}”</p>
                    <div class="font-bold text-gray-900">{{ $review['name'] }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ПОРТФОЛИО --}}
@if($portfolio->count())
<section class="py-20 bg-white">
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
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-red-100 to-gray-100">
                            <i class="fa-solid fa-building text-primary/30 text-6xl"></i>
                        </div>
                    @endif

                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/20 to-transparent opacity-0 group-hover:opacity-100 transition"></div>

                    <div class="absolute bottom-0 left-0 right-0 p-5 translate-y-4 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 transition">
                        @if($item->category)
                            <span class="text-red-300 text-xs font-semibold uppercase tracking-wider">
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

{{-- CTA --}}
<section class="py-20 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-primary to-red-900"></div>

    <div class="container mx-auto max-w-7xl px-4 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="text-white">
                <h2 class="text-4xl font-bold mb-4">
                    {{ $cta?->title ?: 'Получите предварительный расчёт' }}
                </h2>

                <p class="text-red-100 text-lg mb-8 leading-relaxed">
                    {{ $cta?->subtitle ?: 'Оставьте заявку — инженер уточнит параметры объекта и подготовит предложение.' }}
                </p>

                <div class="space-y-4">
                    @foreach([
                        'Подбор решения под параметры объекта',
                        'Предварительная оценка бюджета',
                        'Рекомендации по оборудованию',
                        'Работа с коммерческими и промышленными объектами',
                    ] as $benefit)
                        <div class="flex items-center gap-3">
                            <div class="w-6 h-6 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-check text-white text-xs"></i>
                            </div>
                            <span class="text-red-100">{{ $benefit }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-white rounded-2xl p-8 shadow-2xl">
                <h3 class="text-xl font-bold mb-1">Оставить заявку</h3>
                <p class="text-gray-500 text-sm mb-6">Ответим в рабочее время</p>

                <form id="ctaForm" action="{{ route('lead.order') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="source_url" value="{{ url()->current() }}">

                    <input type="text" name="name" required placeholder="Ваше имя"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">

                    <input type="tel" name="phone" required placeholder="Телефон"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">

                    <input type="email" name="email" placeholder="Email"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">

                    <textarea name="comment" rows="3" placeholder="Кратко опишите задачу"
                              class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary resize-none"></textarea>

                    <button type="button" onclick="submitForm('ctaForm','{{ route('lead.order') }}','cta-success')"
                            class="w-full bg-primary hover:bg-primary-dark text-white py-4 rounded-xl font-bold text-lg transition shadow-lg">
                        {{ $cta?->button_text ?: 'Отправить заявку' }}
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

{{-- ДОПОЛНИТЕЛЬНЫЕ HTML-БЛОКИ ИЗ АДМИНКИ --}}
@if(isset($blocks))
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
@endif

@endsection