@extends('layouts.app')

@section('title', 'О компании — ВТП Инжиниринг')
@section('description', 'ООО «ВТП Инжиниринг» — проектирование, монтаж и сдача тепловых пунктов в Москве и Московской области. Более 10 лет опыта, гарантия 60 месяцев.')

@section('content')

{{-- Hero --}}
<section class="relative bg-gray-900 text-white overflow-hidden">
    <img src="{{ asset('/public/images/about/company-photo.jpg') }}"
         alt="ВТП Инжиниринг — монтаж тепловых пунктов"
         class="absolute inset-0 w-full h-full object-cover opacity-30">

    <div class="relative container mx-auto max-w-7xl px-4 py-20">
        <nav class="text-sm text-gray-400 mb-6 flex items-center gap-2">
            <a href="{{ route('home') }}" class="hover:text-white transition">Главная</a>
            <span>/</span>
            <span class="text-gray-200">О компании</span>
        </nav>

        <h1 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">
            О компании
        </h1>

        <p class="text-xl text-gray-300 max-w-2xl leading-relaxed">
            ООО «ВТП Инжиниринг» — надёжный партнёр в сфере проектирования и монтажа
            тепловых пунктов в Москве и Московской области
        </p>
    </div>
</section>

{{-- Intro text --}}
<section class="py-16 bg-white">
    <div class="container mx-auto max-w-7xl px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-6">
                    Более 10 лет на рынке тепловых пунктов
                </h2>

                <p class="text-gray-600 leading-relaxed mb-4">
                    ООО «ВТП Инжиниринг» заслужило репутацию надёжной компании по комплексу работ,
                    связанных с проектированием, монтажом и сдачей тепловых пунктов. Работаем с
                    ведущими застройщиками и генеральными подрядчиками Москвы и Подмосковья —
                    Level Group, 3Red, РусьСтройПроект.
                </p>

                <p class="text-gray-600 leading-relaxed mb-4">
                    Мы выполняем весь цикл работ: от получения технических условий и разработки
                    проектной документации до монтажа, пуско-наладки и сдачи объекта. Работаем под ключ.
                </p>

                <p class="text-gray-600 leading-relaxed">
                    Наличие собственного производственного участка позволяет нам контролировать
                    качество на каждом этапе и сокращать сроки выполнения работ.
                </p>
            </div>

            <div class="relative">
                <img src="{{ asset('/public/images/about/sotrudniki.jpg') }}"
                     alt="Команда ВТП Инжиниринг"
                     class="rounded-2xl shadow-xl w-full object-cover max-h-80">

                <div class="absolute -bottom-4 -left-4 bg-primary text-white rounded-xl px-6 py-4 shadow-lg">
                    <div class="text-3xl font-bold">10+</div>
                    <div class="text-sm opacity-90">лет опыта</div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- Цифры --}}
<section class="py-14 bg-gray-50">
    <div class="container mx-auto max-w-7xl px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

            <div class="text-center bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <div class="text-4xl font-bold text-primary mb-2">150+</div>
                <div class="text-sm text-gray-500 leading-snug">смонтированных тепловых пунктов</div>
            </div>

            <div class="text-center bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <div class="text-4xl font-bold text-primary mb-2">25+</div>
                <div class="text-sm text-gray-500 leading-snug">объектов в работе одновременно</div>
            </div>

            <div class="text-center bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <div class="text-4xl font-bold text-primary mb-2">60</div>
                <div class="text-sm text-gray-500 leading-snug">месяцев гарантии на все работы</div>
            </div>

            <div class="text-center bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <div class="text-4xl font-bold text-primary mb-2">10+</div>
                <div class="text-sm text-gray-500 leading-snug">бригад специалистов в штате</div>
            </div>

        </div>
    </div>
</section>

{{-- Почему выбирают нас --}}
<section class="py-16 bg-white">
    <div class="container mx-auto max-w-7xl px-4">

        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-3">Почему выбирают ВТП Инжиниринг</h2>
            <p class="text-gray-500 max-w-xl mx-auto">Мы несём полную ответственность за результат на каждом этапе</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <div class="flex gap-4 p-6 rounded-2xl border border-gray-100 hover:border-primary/30 hover:shadow-md transition">
                <div class="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                    <i class="fa-solid fa-check text-primary text-sm"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900 mb-1">Более 10 лет опыта</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">Проектируем, монтируем и сдаём тепловые пункты с 2014 года. Знаем все нормативные требования и регламенты.</p>
                </div>
            </div>

            <div class="flex gap-4 p-6 rounded-2xl border border-gray-100 hover:border-primary/30 hover:shadow-md transition">
                <div class="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                    <i class="fa-solid fa-check text-primary text-sm"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900 mb-1">Масштаб без потери качества</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">Одновременно ведём разностадийные работы более чем на 25 тепловых пунктах по всей Москве и области.</p>
                </div>
            </div>

            <div class="flex gap-4 p-6 rounded-2xl border border-gray-100 hover:border-primary/30 hover:shadow-md transition">
                <div class="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                    <i class="fa-solid fa-check text-primary text-sm"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900 mb-1">Собственное производство</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">Сертифицированный производственный участок по сборке и программированию щитового оборудования — всё под одной крышей.</p>
                </div>
            </div>

            <div class="flex gap-4 p-6 rounded-2xl border border-gray-100 hover:border-primary/30 hover:shadow-md transition">
                <div class="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                    <i class="fa-solid fa-check text-primary text-sm"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900 mb-1">Сильная команда</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">6 бригад сварщиков и слесарей, 4 бригады электромонтажников, 2 инженера КИПиА — закрываем весь цикл работ своими силами.</p>
                </div>
            </div>

            <div class="flex gap-4 p-6 rounded-2xl border border-gray-100 hover:border-primary/30 hover:shadow-md transition">
                <div class="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                    <i class="fa-solid fa-check text-primary text-sm"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900 mb-1">Гарантия 60 месяцев</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">На все выполненные работы предоставляем гарантию 5 лет с момента подписания акта приёмки.</p>
                </div>
            </div>

            <div class="flex gap-4 p-6 rounded-2xl border border-gray-100 hover:border-primary/30 hover:shadow-md transition">
                <div class="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                    <i class="fa-solid fa-check text-primary text-sm"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900 mb-1">Сдача под ключ</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">Берём на себя все согласования и сдачу объекта — клиент получает готовый, сданный тепловой пункт.</p>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- Этапы работ --}}
<section class="py-16 bg-gray-50">
    <div class="container mx-auto max-w-7xl px-4">

        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-3">Этапы работ</h2>
            <p class="text-gray-500 max-w-xl mx-auto">Полный цикл — от технических условий до гарантийного обслуживания</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">

            @php
            $steps = [
                ['num' => '01', 'title' => 'Технические условия', 'icon' => 'fa-file-signature'],
                ['num' => '02', 'title' => 'Разработка проекта', 'icon' => 'fa-drafting-compass'],
                ['num' => '03', 'title' => 'Согласование', 'icon' => 'fa-stamp'],
                ['num' => '04', 'title' => 'Комплектация', 'icon' => 'fa-boxes-stacked'],
                ['num' => '05', 'title' => 'Сварочный монтаж', 'icon' => 'fa-fire-flame-curved'],
                ['num' => '06', 'title' => 'Электромонтаж', 'icon' => 'fa-bolt'],
                ['num' => '07', 'title' => 'Пуско-наладка', 'icon' => 'fa-sliders'],
                ['num' => '08', 'title' => 'Сдача инспекции', 'icon' => 'fa-clipboard-check'],
                ['num' => '09', 'title' => 'Обслуживание', 'icon' => 'fa-wrench'],
                ['num' => '10', 'title' => 'Гарантийный период', 'icon' => 'fa-shield-halved'],
            ];
            @endphp

            @foreach($steps as $step)
            <div class="bg-white rounded-2xl p-5 text-center shadow-sm border border-gray-100 hover:border-primary/30 hover:shadow-md transition">
                <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="fa-solid {{ $step['icon'] }} text-white text-sm"></i>
                </div>
                <div class="text-xs text-gray-400 font-mono mb-1">{{ $step['num'] }}</div>
                <div class="text-sm font-semibold text-gray-800 leading-snug">{{ $step['title'] }}</div>
            </div>
            @endforeach

        </div>
    </div>
</section>

{{-- Галерея работ --}}
<section class="py-16 bg-white">
    <div class="container mx-auto max-w-7xl px-4">

        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-3">Наши объекты</h2>
            <p class="text-gray-500 max-w-xl mx-auto">Примеры выполненных тепловых пунктов в Москве и Московской области</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            @php
            $works = [
                ['img' => 'work-1.jpg', 'title' => 'ИТП Коптевская 65'],
                ['img' => 'work-2.jpg', 'title' => 'ИТП Симферопольский проезд'],
                ['img' => 'work-3.jpg', 'title' => 'ИТП Феодосийская'],
                ['img' => 'work-4.jpg', 'title' => 'ИТП Малая Юшуньская'],
                ['img' => 'work-5.jpg', 'title' => 'ИТП посёлок Лыткарино'],
                ['img' => 'work-6.jpg', 'title' => 'ИТП Балашиха'],
            ];
            @endphp

            @foreach($works as $work)
            <div class="group relative rounded-xl overflow-hidden shadow-sm border border-gray-100">
                <img src="{{ asset('/public/images/about/' . $work['img']) }}"
                     alt="{{ $work['title'] }}"
                     class="w-full h-48 object-cover group-hover:scale-105 transition duration-300">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-4">
                    <span class="text-white text-sm font-medium">{{ $work['title'] }}</span>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-8">
            <a href="{{ route('portfolio') }}"
               class="inline-flex items-center gap-2 bg-primary hover:bg-primary-dark text-white px-6 py-3 rounded-xl font-medium transition shadow-md">
                Все объекты портфолио
                <i class="fa-solid fa-arrow-right text-sm"></i>
            </a>
        </div>

    </div>
</section>

{{-- CTA --}}
<section class="py-16 bg-primary">
    <div class="container mx-auto max-w-7xl px-4 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Нужен тепловой пункт под ключ?</h2>
        <p class="text-white/80 mb-8 max-w-xl mx-auto">
            Оставьте заявку — перезвоним в течение 15 минут и бесплатно проконсультируем
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <button onclick="window.dispatchEvent(new CustomEvent('open-callback-modal'))"
                class="bg-white text-primary hover:bg-gray-100 px-8 py-3 rounded-xl font-semibold transition shadow-md">
                Заказать звонок
            </button>
            <a href="{{ route('contacts') }}"
               class="border-2 border-white text-white hover:bg-white/10 px-8 py-3 rounded-xl font-semibold transition">
                Наши контакты
            </a>
        </div>
    </div>
</section>

@endsection
