<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', $siteName) | {{ $siteName }}</title>
    <meta name="description" content="@yield('description', '')">
    <link rel="icon" type="image/png" href="{{ asset('/public/images/favicon-ik.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('/public/images/favicon-ik.png') }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#cc0000',
                        'primary-dark': '#990000',
},
                    fontFamily: {
                        sans: ['"Trebuchet MS"', 'Arial', 'Tahoma', 'Verdana', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        html { scroll-behavior: smooth; }
        body { font-family: "Trebuchet MS", Arial, Tahoma, Verdana, sans-serif; }

        /* Подменю */
        .has-dropdown:hover > .dropdown { display: block; }
        .has-submenu:hover > .submenu { display: block; }

        .dropdown,
        .submenu {
            white-space: normal;
        }

        /* Чтобы 3-й уровень меню не обрезался */
        nav {
            overflow: visible;
        }

        header {
            overflow: visible;
        }

        /* Анимация подчёркивания для пунктов меню */
        .nav-link::after {
            content: '';
            display: block;
            height: 3px;
            background: rgba(255,255,255,0.5);
            transform: scaleX(0);
            transition: transform 0.2s;
        }

        .nav-link:hover::after {
            transform: scaleX(1);
        }
    </style>

    @if($yandexMetrika)
        <script type="text/javascript">
            (function(m,e,t,r,i,k,a){
                m[i]=m[i]||function(){
                    (m[i].a=m[i].a||[]).push(arguments)
                };
                var z=m[i];
                z.l=1*new Date();
                k=e.createElement(t);
                a=e.getElementsByTagName(t)[0];
                k.async=1;
                k.src=r;
                a.parentNode.insertBefore(k,a)
            })(window,document,"script","https://mc.yandex.ru/metrika/tag.js","ym");

            ym({{ $yandexMetrika }},"init",{
                clickmap:true,
                trackLinks:true,
                accurateTrackBounce:true,
                webvisor:true
            });
        </script>
        <noscript><div><img src="https://mc.yandex.ru/watch/{{ $yandexMetrika }}" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    @endif
</head>

<body class="text-gray-800 bg-white">

{{-- Верхняя строка --}}
<div class="bg-gray-800 text-gray-300 text-xs hidden md:block">
    <div class="container mx-auto max-w-7xl px-4 py-2 flex justify-between items-center">
        <div class="flex items-center gap-5">
            @if($regionAddress)
                <span class="flex items-center gap-1">
                    <i class="fa-solid fa-location-dot text-primary"></i>
                    {{ $regionAddress }}
                </span>
            @endif

            <span class="flex items-center gap-1">
                <i class="fa-regular fa-clock text-primary"></i>
                {{ $regionHours }}
            </span>
        </div>

        <div class="flex items-center gap-4">
            <a href="mailto:{{ $regionEmail }}" class="flex items-center gap-1 hover:text-white transition">
                <i class="fa-regular fa-envelope"></i>
                {{ $regionEmail }}
            </a>
        </div>
    </div>
</div>

{{-- Шапка --}}
<header class="bg-white shadow-lg sticky top-0 z-50" x-data="{
    mobileOpen: false,
    modalOpen: false,
    modalType: 'callback',
    searchOpen: false,
    searchQuery: ''
}"
    @open-callback-modal.window="modalOpen = true; modalType = 'callback'">

    {{-- Основная шапка --}}
    <div class="container mx-auto max-w-7xl px-4">
        <div class="flex items-center justify-between py-4 gap-4">

            {{-- Логотип --}}
        <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center gap-3">
            <img
                src="{{ asset('/public/images/logo-ik-icon.png') }}"
                alt="Инженерный комфорт"
                class="h-[52px] w-auto">
            <span class="text-base md:text-lg font-bold text-gray-900 leading-[1.05]">
                Инженерный<br>комфорт
            </span>
        </a>

            {{-- Регион desktop --}}
            <div class="hidden lg:block flex-shrink-0" x-data="{ open: false }">
                <button @click="open = !open"
                    class="flex items-center gap-2 text-sm text-gray-600 hover:text-primary border border-gray-200 rounded-lg px-3 py-2 transition hover:border-primary">
                    <i class="fa-solid fa-location-dot text-primary"></i>
                    <span class="font-medium">{{ $regionName ?: 'Регион' }}</span>
                    <i class="fa-solid fa-chevron-down text-xs"></i>
                </button>

                <div x-show="open" @click.away="open = false" x-cloak
                    class="absolute mt-1 bg-white border border-gray-100 rounded-xl shadow-xl py-2 z-50 min-w-[200px]">

                    <form method="POST" action="{{ route('region.set') }}" class="contents">
                        @csrf

                        <input type="hidden" name="redirect" value="{{ url()->current() }}">

                        @foreach($allRegions as $region)
                            <button type="submit" name="region" value="{{ $region->slug }}"
                                class="flex items-center gap-3 w-full text-left px-4 py-2.5 text-sm hover:bg-blue-50 hover:text-primary transition
                                {{ ($currentRegion && $currentRegion->slug === $region->slug) ? 'text-primary font-semibold bg-blue-50' : 'text-gray-700' }}">

                                @if($currentRegion && $currentRegion->slug === $region->slug)
                                    <i class="fa-solid fa-check text-primary text-xs"></i>
                                @else
                                    <span class="w-3"></span>
                                @endif

                                {{ $region->name }}
                            </button>
                        @endforeach

                        @if($currentRegion)
                            <hr class="my-1 border-gray-100">

                            <button type="submit" name="region" value="default"
                                class="w-full text-left px-4 py-2 text-xs text-gray-400 hover:text-gray-600 transition">
                                Сбросить регион
                            </button>
                        @endif
                    </form>
                </div>
            </div>

            {{-- Телефон --}}
            <div class="hidden md:block text-right flex-shrink-0">
                <a href="tel:{{ preg_replace('/[^+\d]/', '', $regionPhone) }}"
                    class="flex items-center gap-2 text-xl font-bold text-gray-900 hover:text-primary transition">
                    <i class="fa-solid fa-phone text-primary"></i>
                    {{ $regionPhone }}
                </a>

                <a href="mailto:{{ $regionEmail }}"
                    class="flex items-center justify-end gap-2 text-xl font-bold text-gray-900 hover:text-primary transition mt-1">
                    <i class="fa-regular fa-envelope text-primary"></i>
                    {{ $regionEmail }}
                </a>

                <p class="text-xs text-gray-400 mt-0.5">
                    {{ $regionHours }} по МСК
                </p>
            </div>

            {{-- Поиск + кнопки --}}
            <div class="hidden md:flex items-center gap-3 flex-shrink-0">

                {{-- Поиск --}}
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open; $nextTick(() => $refs.searchInput && $refs.searchInput.focus())"
                        class="w-9 h-9 flex items-center justify-center text-gray-500 hover:text-primary hover:bg-blue-50 rounded-lg transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>

                    <div x-show="open" @click.away="open = false" x-cloak
                        class="absolute right-0 top-full mt-2 w-72 bg-white border border-gray-200 rounded-xl shadow-xl p-3 z-50">

                        <form action="{{ route('services') }}" method="GET" class="flex gap-2">
                            <input x-ref="searchInput" type="text" name="q" placeholder="Поиск по сайту..."
                                class="flex-1 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">

                            <button type="submit" class="bg-primary hover:bg-primary-dark text-white px-3 py-2 rounded-lg transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>

                <button @click="modalOpen = true; modalType = 'callback'"
                    class="border-2 border-primary text-primary hover:bg-primary hover:text-white px-4 py-2 rounded-lg font-medium transition text-sm whitespace-nowrap">
                    Заказать звонок
                </button>

                <a href="{{ route('prices') }}"
                    class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-lg font-medium transition text-sm whitespace-nowrap shadow-md shadow-blue-200 flex items-center gap-1.5">
                    <i class="fas fa-calculator"></i>
                    Подбор онлайн
                </a>

                <div class="flex items-center gap-1.5">
                    <a href="https://vk.com/vtp_inj" target="_blank" rel="noopener" aria-label="ВКонтакте"
                        class="w-9 h-9 rounded-lg bg-gray-100 hover:bg-[#0077FF] hover:text-white text-gray-600 flex items-center justify-center transition">
                        <i class="fab fa-vk"></i>
                    </a>
                    <a href="https://wa.me/79919877947" target="_blank" rel="noopener" aria-label="WhatsApp"
                        class="w-9 h-9 rounded-lg bg-gray-100 hover:bg-[#25D366] hover:text-white text-gray-600 flex items-center justify-center transition">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <a href="https://t.me/vtp_inj" target="_blank" rel="noopener" aria-label="Telegram"
                        class="w-9 h-9 rounded-lg bg-gray-100 hover:bg-[#229ED9] hover:text-white text-gray-600 flex items-center justify-center transition">
                        <i class="fab fa-telegram"></i>
                    </a>
                </div>
            </div>

            {{-- Бургер --}}
            <button @click="mobileOpen = !mobileOpen"
                class="md:hidden p-2 text-gray-600 hover:text-primary hover:bg-blue-50 rounded-lg transition">

                <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>

                <svg x-show="mobileOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Навигация desktop --}}
    <nav class="hidden md:block bg-primary w-full shadow-md">
        <div class="container mx-auto max-w-7xl px-4">
            <div class="flex items-center">

                {{-- О компании --}}
                <div class="has-dropdown relative">
                    <a href="{{ route('about') }}"
                        class="nav-link flex items-center gap-1.5 text-white px-5 py-3.5 text-sm font-semibold uppercase tracking-wider hover:bg-white/10 transition">
                        О компании
                        <svg class="w-3 h-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </a>

                    <div class="dropdown hidden absolute top-full left-0 bg-white rounded-b-xl shadow-2xl py-2 z-40 min-w-[260px] border-t-2 border-primary">
                        <a href="{{ route('about') }}"
                            class="flex items-center gap-2 px-5 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-primary transition border-b border-gray-50">
                            <i class="fa-solid fa-circle-info text-primary opacity-60 w-4"></i>
                            О нас
                        </a>

                        <a href="{{ route('certificates') }}"
                            class="flex items-center gap-2 px-5 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-primary transition border-b border-gray-50">
                            <i class="fa-solid fa-certificate text-primary opacity-60 w-4"></i>
                            Сертификаты
                        </a>

                        <a href="{{ route('requisites') }}"
                            class="flex items-center gap-2 px-5 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-primary transition">
                            <i class="fa-solid fa-file-lines text-primary opacity-60 w-4"></i>
                            Реквизиты
                        </a>
                    </div>
                </div>

                {{-- Услуги --}}
                @if($menuServices->count())
                    <div class="has-dropdown relative">
                        <a href="{{ route('services') }}"
                            class="nav-link flex items-center gap-1.5 text-white px-5 py-3.5 text-sm font-semibold uppercase tracking-wider hover:bg-white/10 transition">
                            Услуги
                            <svg class="w-3 h-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </a>

                        <div class="dropdown hidden absolute top-full left-0 bg-white rounded-b-xl shadow-2xl py-2 z-40 min-w-[380px] border-t-2 border-primary">

                            @foreach($menuServices as $service)

                                @if($service->children->count())
                                    <div class="has-submenu relative">
                                        <div class="flex items-center justify-between px-5 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-primary transition border-b border-gray-50 cursor-pointer group">
                                            <a href="{{ route('service', $service->slug) }}" class="flex-1 font-medium leading-snug">
                                                {{ $service->title }}
                                            </a>

                                            <svg class="w-4 h-4 text-gray-400 group-hover:text-primary flex-shrink-0 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </div>

                                        <div class="submenu hidden absolute left-full top-0 bg-white rounded-xl shadow-2xl py-2 z-50 min-w-[380px] border-l-2 border-primary ml-0.5 overflow-y-auto" style="max-height:calc(100vh - 100px)">

                                            @foreach($service->children as $child)

                                                @if($child->children->count())
                                                    <div class="has-submenu relative">
                                                        <div class="flex items-center justify-between px-5 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-primary transition border-b border-gray-50 cursor-pointer group">
                                                            <a href="{{ route('service', $child->slug) }}" class="flex-1 font-medium leading-snug">
                                                                {{ $child->title }}
                                                            </a>

                                                            <svg class="w-4 h-4 text-gray-400 group-hover:text-primary flex-shrink-0 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                                            </svg>
                                                        </div>

                                                        <div class="submenu hidden absolute left-full top-0 bg-white rounded-xl shadow-2xl py-2 z-50 min-w-[380px] border-l-2 border-primary ml-0.5">
                                                            @foreach($child->children as $grandchild)
                                                                <a href="{{ route('service', $grandchild->slug) }}"
                                                                    class="block px-5 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-primary transition border-b border-gray-50 leading-snug">
                                                                    {{ $grandchild->title }}
                                                                </a>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @else
                                                    <a href="{{ route('service', $child->slug) }}"
                                                        class="block px-5 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-primary transition border-b border-gray-50 leading-snug">
                                                        {{ $child->title }}
                                                    </a>
                                                @endif

                                            @endforeach

                                        </div>
                                    </div>
                                @else
                                    <a href="{{ route('service', $service->slug) }}"
                                        class="block px-5 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-primary transition border-b border-gray-50 leading-snug">
                                        {{ $service->title }}
                                    </a>
                                @endif

                            @endforeach

                        </div>
                    </div>
                @endif

                {{-- Проектирование --}}
                <a href="{{ route('service', 'proektirovanie') }}"
                    class="nav-link text-white px-5 py-3.5 text-sm font-semibold uppercase tracking-wider hover:bg-white/10 transition">
                    Проектирование
                </a>

                <a href="{{ route('prices') }}"
                    class="nav-link text-white px-5 py-3.5 text-sm font-semibold uppercase tracking-wider hover:bg-white/10 transition">
                    Цены
                </a>

                <a href="{{ route('news') }}"
                    class="nav-link text-white px-5 py-3.5 text-sm font-semibold uppercase tracking-wider hover:bg-white/10 transition">
                    Новости
                </a>

                <a href="{{ route('videos') }}"
                    class="nav-link text-white px-5 py-3.5 text-sm font-semibold uppercase tracking-wider hover:bg-white/10 transition">
                    Видео
                </a>

                <a href="{{ route('contacts') }}"
                    class="nav-link text-white px-5 py-3.5 text-sm font-semibold uppercase tracking-wider hover:bg-white/10 transition">
                    Контакты
                </a>

                <a href="{{ route('portfolio') }}"
                    class="nav-link text-white px-5 py-3.5 text-sm font-semibold uppercase tracking-wider hover:bg-white/10 transition">
                    Портфолио
                </a>

            </div>
        </div>
    </nav>

    {{-- Мобильное меню --}}
    <div x-show="mobileOpen" x-cloak class="md:hidden border-t bg-white shadow-lg overflow-y-auto" style="max-height:calc(100vh - 80px)">
        <div class="px-4 py-3 space-y-1">

            <a href="{{ route('about') }}"
                class="block px-3 py-2.5 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-primary font-medium transition">
                О компании
            </a>

            <a href="{{ route('certificates') }}"
                class="block px-3 py-2.5 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-primary font-medium transition">
                Сертификаты
            </a>

            <a href="{{ route('requisites') }}"
                class="block px-3 py-2.5 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-primary font-medium transition">
                Реквизиты
            </a>

            <a href="{{ route('services') }}"
                class="block px-3 py-2.5 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-primary font-medium transition">
                Услуги
            </a>

            @if($menuServices->count())
                <div class="ml-3 space-y-0.5">
                    @foreach($menuServices as $service)
                        @if($service->children->count())
                            <div x-data="{ open: false }">
                                <div class="flex items-center">
                                    <a href="{{ route('service', $service->slug) }}"
                                        class="flex-1 px-3 py-2 text-sm rounded-l-lg text-gray-600 hover:bg-blue-50 hover:text-primary transition">
                                        {{ $service->title }}
                                    </a>
                                    <button @click="open = !open"
                                        class="px-2 py-2 text-gray-400 hover:text-primary transition"
                                        :aria-expanded="open">
                                        <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </button>
                                </div>
                                <div x-show="open" class="ml-3 border-l border-blue-100 pl-2 space-y-0.5">
                                    @foreach($service->children as $child)
                                        @if($child->children->count())
                                            <div x-data="{ open: false }">
                                                <div class="flex items-center">
                                                    <a href="{{ route('service', $child->slug) }}"
                                                        class="flex-1 px-2 py-1.5 text-xs rounded-l-lg text-gray-500 hover:bg-blue-50 hover:text-primary transition">
                                                        {{ $child->title }}
                                                    </a>
                                                    <button @click="open = !open"
                                                        class="px-2 py-1.5 text-gray-400 hover:text-primary transition">
                                                        <svg class="w-3 h-3 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                                <div x-show="open" class="ml-3 border-l border-gray-100 pl-2 space-y-0.5">
                                                    @foreach($child->children as $grandchild)
                                                        <a href="{{ route('service', $grandchild->slug) }}"
                                                            class="block px-2 py-1 text-xs rounded-lg text-gray-400 hover:bg-blue-50 hover:text-primary transition">
                                                            {{ $grandchild->title }}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @else
                                            <a href="{{ route('service', $child->slug) }}"
                                                class="block px-2 py-1.5 text-xs rounded-lg text-gray-500 hover:bg-blue-50 hover:text-primary transition">
                                                {{ $child->title }}
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <a href="{{ route('service', $service->slug) }}"
                                class="block px-3 py-2 text-sm rounded-lg text-gray-600 hover:bg-blue-50 hover:text-primary transition">
                                {{ $service->title }}
                            </a>
                        @endif
                    @endforeach
                </div>
            @endif

            <a href="{{ route('service', 'proektirovanie') }}"
                class="block px-3 py-2.5 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-primary font-medium transition">
                Проектирование
            </a>

            <a href="{{ route('prices') }}"
                class="block px-3 py-2.5 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-primary font-medium transition">
                Цены
            </a>

            <a href="{{ route('news') }}"
                class="block px-3 py-2.5 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-primary font-medium transition">
                Новости
            </a>

            <a href="{{ route('videos') }}"
                class="block px-3 py-2.5 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-primary font-medium transition">
                Видео
            </a>

            <a href="{{ route('contacts') }}"
                class="block px-3 py-2.5 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-primary font-medium transition">
                Контакты
            </a>

            <a href="{{ route('portfolio') }}"
                class="block px-3 py-2.5 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-primary font-medium transition">
                Портфолио
            </a>
        </div>

        <div class="px-4 pb-4 space-y-3 border-t pt-3">
            <a href="tel:{{ preg_replace('/[^+\d]/', '', $regionPhone) }}"
                class="flex items-center justify-center gap-2 font-bold text-xl text-primary">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                </svg>
                {{ $regionPhone }}
            </a>

            <form method="POST" action="{{ route('region.set') }}">
                @csrf

                <input type="hidden" name="redirect" value="{{ url()->current() }}">

                <select name="region" onchange="this.form.submit()"
                    class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary">
                    <option value="">Выбрать регион</option>

                    @foreach($allRegions as $region)
                        <option value="{{ $region->slug }}"
                            {{ ($currentRegion && $currentRegion->slug === $region->slug) ? 'selected' : '' }}>
                            {{ $region->name }}
                        </option>
                    @endforeach
                </select>
            </form>

            <button @click="modalOpen = true; modalType = 'callback'; mobileOpen = false"
                class="w-full border-2 border-primary text-primary py-2.5 rounded-lg font-medium">
                Заказать звонок
            </button>

            <a href="{{ route('prices') }}"
                class="w-full bg-primary text-white py-2.5 rounded-lg font-medium shadow-md shadow-blue-200 flex items-center justify-center gap-2">
                <i class="fas fa-calculator"></i>
                Подбор онлайн
            </a>

            <div class="flex items-center justify-center gap-3 pt-2">
                <a href="https://vk.com/vtp_inj" target="_blank" rel="noopener" aria-label="ВКонтакте"
                    class="w-11 h-11 rounded-xl bg-gray-100 hover:bg-[#0077FF] hover:text-white text-gray-700 flex items-center justify-center transition text-lg">
                    <i class="fab fa-vk"></i>
                </a>
                <a href="https://wa.me/79919877947" target="_blank" rel="noopener" aria-label="WhatsApp"
                    class="w-11 h-11 rounded-xl bg-gray-100 hover:bg-[#25D366] hover:text-white text-gray-700 flex items-center justify-center transition text-lg">
                    <i class="fab fa-whatsapp"></i>
                </a>
                <a href="https://t.me/vtp_inj" target="_blank" rel="noopener" aria-label="Telegram"
                    class="w-11 h-11 rounded-xl bg-gray-100 hover:bg-[#229ED9] hover:text-white text-gray-700 flex items-center justify-center transition text-lg">
                    <i class="fab fa-telegram"></i>
                </a>
            </div>
        </div>
    </div>

    {{-- Модальное окно --}}
    <div x-show="modalOpen" x-cloak
        class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4"
        @click.self="modalOpen = false">

        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 relative">

            <button @click="modalOpen = false"
                class="absolute top-4 right-4 w-8 h-8 flex items-center justify-center text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-full transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            {{-- Callback --}}
            <div x-show="modalType === 'callback'">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-primary" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                        </svg>
                    </div>

                    <div>
                        <h3 class="text-xl font-bold">Заказать звонок</h3>
                        <p class="text-sm text-gray-500">Перезвоним в течение 15 минут</p>
                    </div>
                </div>

                <form id="callbackForm" action="{{ route('lead.callback') }}" method="POST">
                    @csrf

                    <input type="hidden" name="source_url" value="{{ url()->current() }}">

                    <div class="space-y-3">
                        <input type="text" name="name" placeholder="Ваше имя"
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition">

                        <input type="tel" name="phone" placeholder="Ваш телефон *" required
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition">

                        <button type="button" onclick="submitForm('callbackForm', '{{ route('lead.callback') }}', 'callback-success')"
                            class="w-full bg-primary hover:bg-primary-dark text-white py-3 rounded-xl font-semibold transition shadow-md shadow-blue-200">
                            Перезвоните мне
                        </button>
                    </div>

                    <p class="text-xs text-gray-400 mt-3 text-center">
                        Нажимая кнопку, вы соглашаетесь с
                        <a href="#" class="underline hover:text-gray-600">политикой конфиденциальности</a>
                    </p>
                </form>

                <div id="callback-success" class="hidden text-center py-8">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-500" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                        </svg>
                    </div>

                    <p class="font-bold text-lg">Спасибо!</p>
                    <p class="text-gray-500 mt-1">Мы перезвоним вам в ближайшее время.</p>
                </div>
            </div>

            {{-- Order --}}
            <div x-show="modalType === 'order'">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-primary" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 3c1.93 0 3.5 1.57 3.5 3.5S13.93 13 12 13s-3.5-1.57-3.5-3.5S10.07 6 12 6zm7 13H5v-.23c0-.62.28-1.2.76-1.58C7.47 15.82 9.64 15 12 15s4.53.82 6.24 2.19c.48.38.76.97.76 1.58V19z"/>
                        </svg>
                    </div>

                    <div>
                        <h3 class="text-xl font-bold">Оставить заявку</h3>
                        <p class="text-sm text-gray-500">Свяжемся в течение 1 часа</p>
                    </div>
                </div>

                <form id="orderForm" action="{{ route('lead.order') }}" method="POST">
                    @csrf

                    <input type="hidden" name="source_url" value="{{ url()->current() }}">

                    <div class="space-y-3">
                        <input type="text" name="name" placeholder="Ваше имя *" required
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition">

                        <input type="tel" name="phone" placeholder="Телефон *" required
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition">

                        <input type="email" name="email" placeholder="Email"
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition">

                        <textarea name="comment" placeholder="Комментарий" rows="3"
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition resize-none"></textarea>

                        <button type="button" onclick="submitForm('orderForm', '{{ route('lead.order') }}', 'order-success')"
                            class="w-full bg-primary hover:bg-primary-dark text-white py-3 rounded-xl font-semibold transition shadow-md shadow-blue-200">
                            Отправить заявку
                        </button>
                    </div>

                    <p class="text-xs text-gray-400 mt-3 text-center">
                        Нажимая кнопку, вы соглашаетесь с
                        <a href="#" class="underline hover:text-gray-600">политикой конфиденциальности</a>
                    </p>
                </form>

                <div id="order-success" class="hidden text-center py-8">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-500" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                        </svg>
                    </div>

                    <p class="font-bold text-lg">Заявка принята!</p>
                    <p class="text-gray-500 mt-1">Мы свяжемся с вами в ближайшее время.</p>
                </div>
            </div>
        </div>
    </div>
</header>

@if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 px-4 py-3 text-center text-sm">
        ✓ {{ session('success') }}
    </div>
@endif

<main>
    @yield('content')
</main>

{{-- Подвал --}}
<footer class="bg-gray-900 text-gray-400 mt-16">
    <div class="container mx-auto max-w-7xl px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

            <div>
                <div class="flex items-center gap-3 mb-4">
                    <img src="/public/images/logo-ik-icon.png"
                         alt="Инженерный комфорт"
                         class="h-12 w-auto object-contain flex-shrink-0 bg-white rounded-lg p-1.5">
                    <span class="text-base font-bold text-white leading-[1.05]">
                        Инженерный<br>комфорт
                    </span>
                </div>

                <p class="text-sm text-gray-500 mb-4 leading-relaxed">
                    Проектирование, производство, монтаж.
                </p>

                @if($regionName)
                    <span class="inline-flex items-center gap-1.5 bg-primary/20 text-blue-300 text-xs px-3 py-1.5 rounded-full">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/>
                        </svg>
                        {{ $regionName }}
                    </span>
                @endif
            </div>

            <div>
                <h4 class="text-white font-bold mb-4 text-sm uppercase tracking-wider">
                    Услуги
                </h4>

                <ul class="space-y-2 text-sm">
                    @foreach($menuServices->take(6) as $service)
                        <li>
                            <a href="{{ route('service', $service->slug) }}" class="hover:text-white transition leading-snug block">
                                {{ $service->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h4 class="text-white font-bold mb-4 text-sm uppercase tracking-wider">
                    Разделы
                </h4>

                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('about') }}" class="hover:text-white transition">О компании</a></li>
                    <li><a href="{{ route('services') }}" class="hover:text-white transition">Услуги</a></li>
                    <li><a href="{{ route('prices') }}" class="hover:text-white transition">Цены</a></li>
                    <li><a href="{{ route('news') }}" class="hover:text-white transition">Новости</a></li>
                    <li><a href="{{ route('portfolio') }}" class="hover:text-white transition">Портфолио</a></li>
                    <li><a href="{{ route('videos') }}" class="hover:text-white transition">Видео</a></li>
                    <li><a href="{{ route('contacts') }}" class="hover:text-white transition">Контакты</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-bold mb-4 text-sm uppercase tracking-wider">
                    Контакты
                </h4>

                <ul class="space-y-3 text-sm">
                    @if($regionAddress)
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 text-primary mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/>
                            </svg>
                            <span>{{ $regionAddress }}</span>
                        </li>
                    @endif

                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-primary flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                        </svg>

                        <a href="tel:{{ preg_replace('/[^+\d]/', '', $regionPhone) }}" class="hover:text-white transition font-medium text-gray-300">
                            {{ $regionPhone }}
                        </a>
                    </li>

                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-primary flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                        </svg>

                        <a href="mailto:{{ $regionEmail }}" class="hover:text-white transition">
                            {{ $regionEmail }}
                        </a>
                    </li>

                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-primary flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67V7z"/>
                        </svg>

                        <span>{{ $regionHours }}</span>
                    </li>
                </ul>

                <button type="button"
                    onclick="window.dispatchEvent(new CustomEvent('open-callback-modal'))"
                    class="mt-5 w-full bg-primary hover:bg-primary-dark text-white py-2.5 rounded-lg text-sm font-medium transition">
                    Заказать звонок
                </button>
            </div>

        </div>
    </div>

    <div class="border-t border-gray-800">
        <div class="container mx-auto max-w-7xl px-4 py-4 flex flex-col md:flex-row justify-between items-center text-xs text-gray-600 gap-2">
            <p>
                {{ $footerText ?: '© ' . date('Y') . ' ' . $siteName . '. Все права защищены.' }}
            </p>

            <a href="/privacy" class="hover:text-gray-400 transition">
                Политика конфиденциальности
            </a>
        </div>
    </div>
</footer>

<script>
async function submitForm(formId, url, successId) {
    const form = document.getElementById(formId);

    if (!form) {
        console.error('Form not found:', formId);
        return;
    }

    const data = new FormData(form);

    try {
        const resp = await fetch(url, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: data
        });

        const json = await resp.json();

        if (json.success) {
            form.classList.add('hidden');

            const successBlock = document.getElementById(successId);

            if (successBlock) {
                successBlock.classList.remove('hidden');
            }
        } else if (json && json.errors) {
            alert(Object.values(json.errors).flat().join('\n'));
        }
    } catch(e) {
        console.error(e);
    }
}
</script>

<script>
(function () {
    // Маска телефона: любой ввод → +7 (XXX) XXX-XX-XX
    function maskPhone(value) {
        var d = value.replace(/\D/g, '');
        if (!d) return '';
        if (d[0] === '8') d = '7' + d.slice(1);
        if (d[0] !== '7') d = '7' + d;
        d = d.slice(0, 11);
        var rest = d.slice(1);
        var out = '+7';
        if (rest.length > 0) out += ' (' + rest.slice(0, 3);
        if (rest.length >= 3) out += ') ' + rest.slice(3, 6);
        if (rest.length >= 6) out += '-' + rest.slice(6, 8);
        if (rest.length >= 8) out += '-' + rest.slice(8, 10);
        return out;
    }
    function isPhone(el) {
        return el && el.tagName === 'INPUT' && el.name === 'phone';
    }
    document.addEventListener('input', function (e) {
        if (isPhone(e.target)) e.target.value = maskPhone(e.target.value);
    });
    document.addEventListener('focus', function (e) {
        if (isPhone(e.target) && !e.target.value) e.target.value = '+7 (';
    }, true);
    document.addEventListener('blur', function (e) {
        // если пользователь зашёл в поле, но не ввёл цифры — очистим, чтобы работал required
        if (isPhone(e.target) && e.target.value.replace(/\D/g, '').length <= 1) e.target.value = '';
    }, true);
}());
</script>

<script>
(function () {
    function reachEmailGoal(eventName) {
        if (typeof ym === 'function') {
            ym(109607430, 'reachGoal', 'emailbind');
        }

        console.log(eventName);
    }

    document.addEventListener('copy', function (event) {
        var link = event.target.closest && event.target.closest('a[href*="mailto"]');
        if (link) reachEmailGoal('email-copy');
    });

    document.addEventListener('click', function (event) {
        var link = event.target.closest && event.target.closest('a[href*="mailto"]');
        if (link) reachEmailGoal('email-click');
    });
}());
</script>

</body>
</html>
