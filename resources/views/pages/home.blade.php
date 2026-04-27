@extends('layouts.app')
@section('title', 'Проектирование и монтаж тепловых пунктов под ключ')
@section('description', 'Монтаж ИТП, ЦТП и УУТЭ. Сдача в ПАО МОЭК и МТУ Ростехнадзора. Опыт 15+ лет. Более 500 объектов.')

@section('content')

{{-- HERO --}}
<section class="relative min-h-[600px] flex items-center overflow-hidden bg-gray-900">
    {{-- Фоновое изображение --}}
    <div class="absolute inset-0">
        <img src="https://www.teplovoy-punkt.ru/upload/resize_cache/iblock/500/1920_600_2/5008b33149d903cab2b1ce9f5ab075b8.jpg"
             alt="Тепловой пункт"
             class="w-full h-full object-cover opacity-40"
             onerror="this.style.display='none'">
        <div class="absolute inset-0 bg-gradient-to-r from-gray-900 via-gray-900/80 to-transparent"></div>
    </div>

    <div class="container mx-auto max-w-7xl px-4 relative z-10 py-20">
        <div class="max-w-2xl">
            {{-- Бейдж --}}
            <div class="inline-flex items-center gap-2 bg-primary/20 border border-primary/40 text-blue-300 rounded-full px-4 py-1.5 text-sm font-medium mb-6">
                <span class="w-2 h-2 bg-blue-400 rounded-full animate-pulse"></span>
                Более 500 объектов сдано в эксплуатацию
            </div>

            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6">
                Монтаж тепловых<br>
                пунктов под ключ<br>
                <span class="text-primary">от 40 дней</span>
            </h1>

            <p class="text-xl text-gray-300 mb-4 leading-relaxed">
                Проектирование, монтаж и сдача ИТП, ЦТП и УУТЭ<br>
                в ПАО «МОЭК» и МТУ Ростехнадзора
            </p>

            {{-- Ключевые преимущества --}}
            <div class="flex flex-wrap gap-4 mb-8">
                @foreach(['✓ Ускоренное согласование в МОЭК', '✓ Собственное производство', '✓ Гарантия на работы'] as $item)
                <span class="text-green-400 text-sm font-medium">{{ $item }}</span>
                @endforeach
            </div>

            <div class="flex flex-wrap gap-4">
                <button onclick="document.querySelector('[x-data]').__x.$data.modalOpen=true;document.querySelector('[x-data]').__x.$data.modalType='order'"
                    class="bg-primary hover:bg-primary-dark text-white px-8 py-4 rounded-xl font-bold text-lg transition shadow-lg shadow-blue-900/50 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 3c1.93 0 3.5 1.57 3.5 3.5S13.93 13 12 13s-3.5-1.57-3.5-3.5S10.07 6 12 6zm7 13H5v-.23c0-.62.28-1.2.76-1.58C7.47 15.82 9.64 15 12 15s4.53.82 6.24 2.19c.48.38.76.97.76 1.58V19z"/></svg>
                    Получить расчёт бесплатно
                </button>
                <a href="{{ route('portfolio') }}"
                    class="border-2 border-white/30 text-white hover:border-white hover:bg-white/10 px-8 py-4 rounded-xl font-bold text-lg transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg>
                    Наши проекты
                </a>
            </div>
        </div>
    </div>

    {{-- Счётчики в правом углу --}}
    <div class="absolute right-8 bottom-8 hidden lg:flex gap-6">
        @foreach([
            ['num' => '500+', 'text' => 'объектов'],
            ['num' => '15', 'text' => 'лет опыта'],
            ['num' => '40', 'text' => 'дней срок'],
        ] as $stat)
        <div class="text-center bg-white/10 backdrop-blur rounded-xl p-4 border border-white/20">
            <div class="text-3xl font-bold text-white">{{ $stat['num'] }}</div>
            <div class="text-gray-400 text-sm">{{ $stat['text'] }}</div>
        </div>
        @endforeach
    </div>
</section>

{{-- ПРЕИМУЩЕСТВА --}}
<section class="py-6 bg-primary">
    <div class="container mx-auto max-w-7xl px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-white text-center">
            @foreach([
                ['icon' => '<i class="fa-solid fa-certificate text-2xl text-white"></i>', 'title' => 'Сдача в МОЭК', 'desc' => 'и МТУ Ростехнадзора'],
                ['icon' => '<i class="fa-solid fa-bolt text-2xl text-white"></i>', 'title' => 'Ускоренное', 'desc' => 'согласование проектов'],
                ['icon' => '<i class="fa-solid fa-industry text-2xl text-white"></i>', 'title' => 'Собственное', 'desc' => 'производство щитов'],
                ['icon' => '<i class="fa-solid fa-handshake text-2xl text-white"></i>', 'title' => 'Дилеры', 'desc' => 'ведущих производителей'],
            ] as $item)
            <div class="flex items-center gap-3 py-3">
                <span class="text-2xl flex-shrink-0">{!! $item['icon'] !!}</span>
                <div class="text-left">
                    <div class="font-bold text-sm">{{ $item['title'] }}</div>
                    <div class="text-blue-200 text-xs">{{ $item['desc'] }}</div>
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
            <h2 class="text-4xl font-bold mt-2 mb-4">Наши услуги</h2>
            <p class="text-gray-500 max-w-2xl mx-auto">Полный цикл работ — от проектирования до сдачи объекта в эксплуатацию</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($services as $i => $service)
            <a href="{{ route('service', $service->slug) }}"
                class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 hover:border-primary/30 hover:-translate-y-1">
                <div class="relative h-48 overflow-hidden bg-gradient-to-br from-blue-50 to-blue-100">
                    @if($service->image)
                    <img src="{{ asset('storage/' . $service->image) }}"
                         alt="{{ $service->title }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    @else
                    <div class="w-full h-full flex items-center justify-center">
                        <svg class="w-20 h-20 text-primary/30" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 3L2 12h3v9h6v-6h2v6h6v-9h3L12 3z"/>
                        </svg>
                    </div>
                    @endif
                    <div class="absolute top-4 left-4">
                        <span class="bg-primary text-white text-xs font-bold px-3 py-1 rounded-full">0{{ $i+1 }}</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="font-bold text-lg mb-2 group-hover:text-primary transition leading-snug">
                        {{ $service->title }}
                    </h3>
                    @if($service->excerpt)
                    <p class="text-gray-500 text-sm leading-relaxed">{{ $service->excerpt }}</p>
                    @endif
                    <div class="mt-4 flex items-center text-primary text-sm font-semibold">
                        Подробнее
                        <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        <div class="text-center mt-10">
            <a href="{{ route('services') }}"
                class="inline-flex items-center gap-2 bg-primary hover:bg-primary-dark text-white px-8 py-3.5 rounded-xl font-semibold transition shadow-md shadow-blue-200">
                Все услуги
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
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
            <h2 class="text-4xl font-bold mt-2 mb-4">Как мы работаем</h2>
            <p class="text-gray-500">От заявки до сдачи объекта — полный контроль на каждом этапе</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 relative">
            {{-- Линия между шагами --}}
            <div class="hidden lg:block absolute top-10 left-1/4 right-1/4 h-0.5 bg-primary/20" style="left:12%;right:12%"></div>

            @foreach([
                ['step' => '01', 'icon' => '<i class="fa-solid fa-file-lines fa-xl text-primary"></i>', 'title' => 'Заявка и расчёт', 'desc' => 'Оставьте заявку — наш специалист свяжется с вами в течение 15 минут и сделает бесплатный расчёт'],
                ['step' => '02', 'icon' => '<i class="fa-solid fa-drafting-compass fa-xl text-primary"></i>', 'title' => 'Проектирование', 'desc' => 'Разрабатываем проектную документацию и согласовываем её в ПАО «МОЭК» в ускоренные сроки'],
                ['step' => '03', 'icon' => '<i class="fa-solid fa-gears fa-xl text-primary"></i>', 'title' => 'Монтаж', 'desc' => 'Выполняем монтаж оборудования собственными силами, обеспечивая качество на каждом этапе'],
                ['step' => '04', 'icon' => '<i class="fa-solid fa-circle-check fa-xl text-primary"></i>', 'title' => 'Сдача объекта', 'desc' => 'Сдаём объект в ПАО «МОЭК» и МТУ Ростехнадзора, оформляем всю исполнительную документацию'],
            ] as $step)
            <div class="relative text-center">
                <div class="w-20 h-20 bg-primary/10 rounded-2xl flex items-center justify-center mx-auto mb-4 relative">
                    <span>{!! $step['icon'] !!}</span>
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

{{-- CTA ФОРМА --}}
<section class="py-20 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-primary to-blue-800"></div>
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 left-10 w-72 h-72 bg-white rounded-full filter blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-white rounded-full filter blur-3xl"></div>
    </div>
    <div class="container mx-auto max-w-7xl px-4 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="text-white">
                <h2 class="text-4xl font-bold mb-4">Получите бесплатный расчёт стоимости</h2>
                <p class="text-blue-100 text-lg mb-8 leading-relaxed">
                    Оставьте заявку прямо сейчас и наш инженер подготовит коммерческое предложение под ваш объект в течение 1 рабочего дня
                </p>
                <div class="space-y-4">
                    @foreach([
                        'Выезд специалиста на объект бесплатно',
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
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ваше имя *</label>
                        <input type="text" name="name" required placeholder="Иван Иванов"
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Телефон *</label>
                        <input type="tel" name="phone" required placeholder="+7 (___) ___-__-__"
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" placeholder="ivan@company.ru"
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Описание объекта</label>
                        <textarea name="comment" rows="3" placeholder="Тип объекта, площадь, адрес..."
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition resize-none"></textarea>
                    </div>
                    <button type="button" onclick="submitForm('ctaForm','{{ route('lead.order') }}','cta-success')"
                        class="w-full bg-primary hover:bg-primary-dark text-white py-4 rounded-xl font-bold text-lg transition shadow-lg shadow-blue-200">
                        Получить расчёт бесплатно
                    </button>
                    <p class="text-xs text-gray-400 text-center">
                        Нажимая кнопку, вы соглашаетесь с <a href="#" class="underline">политикой конфиденциальности</a>
                    </p>
                </form>
                <div id="cta-success" class="hidden text-center py-8">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-500" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
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
            <a href="{{ route('portfolio') }}"
                class="hidden md:flex items-center gap-2 text-primary font-semibold hover:text-primary-dark transition">
                Все проекты
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($portfolio as $item)
            <a href="{{ route('portfolio.item', $item->slug) }}"
                class="group relative rounded-2xl overflow-hidden aspect-[4/3] bg-gray-200 shadow-sm hover:shadow-xl transition-all duration-300">
                @if($item->image)
                <img src="{{ $item->image }}"
                     alt="{{ $item->title }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                @else
                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-100 to-blue-200">
                    <svg class="w-16 h-16 text-primary/30" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3L2 12h3v9h6v-6h2v6h6v-9h3L12 3z"/></svg>
                </div>
                @endif

                {{-- Оверлей --}}
                <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/20 to-transparent opacity-0 group-hover:opacity-100 transition duration-300"></div>
                <div class="absolute bottom-0 left-0 right-0 p-5 translate-y-4 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 transition duration-300">
                    @if($item->category)
                    <span class="text-blue-300 text-xs font-semibold uppercase tracking-wider">{{ $item->category }}</span>
                    @endif
                    <h3 class="text-white font-bold mt-1">{{ $item->title }}</h3>
                </div>

                {{-- Постоянный лейбл --}}
                @if($item->category)
                <div class="absolute top-4 left-4">
                    <span class="bg-primary/90 backdrop-blur text-white text-xs font-semibold px-3 py-1 rounded-full">
                        {{ $item->category }}
                    </span>
                </div>
                @endif
            </a>
            @endforeach
        </div>

        <div class="text-center mt-8 md:hidden">
            <a href="{{ route('portfolio') }}"
                class="inline-flex items-center gap-2 bg-primary text-white px-8 py-3 rounded-xl font-semibold">
                Все проекты
            </a>
        </div>
    </div>
</section>
@endif

{{-- НОВОСТИ --}}
@if($news->count())
<section class="py-20 bg-white">
    <div class="container mx-auto max-w-7xl px-4">
        <div class="flex items-end justify-between mb-14">
            <div>
                <span class="text-primary font-semibold text-sm uppercase tracking-widest">Актуально</span>
                <h2 class="text-4xl font-bold mt-2">Новости</h2>
            </div>
            <a href="{{ route('news') }}"
                class="hidden md:flex items-center gap-2 text-primary font-semibold hover:text-primary-dark transition">
                Все новости
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($news as $i => $item)
            <a href="{{ route('news.item', $item->slug) }}"
                class="group {{ $i === 0 ? 'md:row-span-2 md:col-span-1' : '' }}">
                <div class="bg-gray-50 rounded-2xl overflow-hidden h-full hover:shadow-lg transition border border-gray-100 hover:border-primary/20">
                    @if($item->image)
                    <img src="{{ $item->image }}"
                         alt="{{ $item->title }}"
                         class="w-full {{ $i === 0 ? 'h-64' : 'h-40' }} object-cover group-hover:scale-105 transition duration-300">
                    @else
                    <div class="w-full {{ $i === 0 ? 'h-64' : 'h-40' }} bg-gradient-to-br from-blue-50 to-blue-100 flex items-center justify-center">
                        <svg class="w-12 h-12 text-primary/30" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-1.99.9-1.99 2L3 19c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg>
                    </div>
                    @endif
                    <div class="p-5">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                            <span class="text-gray-400 text-xs">{{ $item->published_at?->format('d.m.Y') }}</span>
                        </div>
                        <h3 class="font-bold {{ $i === 0 ? 'text-xl' : 'text-base' }} group-hover:text-primary transition leading-snug">
                            {{ $item->title }}
                        </h3>
                        @if($item->excerpt && $i === 0)
                        <p class="text-gray-500 text-sm mt-2 leading-relaxed">{{ Str::limit($item->excerpt, 120) }}</p>
                        @endif
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- КОНТАКТЫ БЫСТРЫЕ --}}
<section class="py-16 bg-gray-900 text-white">
    <div class="container mx-auto max-w-7xl px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <div class="flex flex-col items-center">
                <div class="w-14 h-14 bg-primary/20 rounded-2xl flex items-center justify-center mb-4">
                    <i class="fa-solid fa-phone fa-lg text-primary"></i>
                </div>
                <p class="text-gray-400 text-sm mb-1">Позвоните нам</p>
                <a href="tel:{{ preg_replace('/[^+\d]/', '', $regionPhone) }}"
                    class="text-2xl font-bold hover:text-primary transition">{{ $regionPhone }}</a>
                <p class="text-gray-500 text-sm mt-1">{{ $regionHours }}</p>
            </div>
            <div class="flex flex-col items-center">
                <div class="w-14 h-14 bg-primary/20 rounded-2xl flex items-center justify-center mb-4">
                    <i class="fa-solid fa-envelope fa-lg text-primary"></i>
                </div>
                <p class="text-gray-400 text-sm mb-1">Напишите нам</p>
                <a href="mailto:{{ $regionEmail }}"
                    class="text-xl font-bold hover:text-primary transition">{{ $regionEmail }}</a>
                <p class="text-gray-500 text-sm mt-1">Ответим в течение часа</p>
            </div>
            <div class="flex flex-col items-center">
                <div class="w-14 h-14 bg-primary/20 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-7 h-7 text-primary" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                </div>
                <p class="text-gray-400 text-sm mb-1">Наш адрес</p>
                <p class="text-xl font-bold">{{ $regionAddress ?: 'г. Москва' }}</p>
                <a href="{{ route('contacts') }}" class="text-primary text-sm mt-1 hover:underline">Показать на карте →</a>
            </div>
        </div>
    </div>
</section>

@endsection
