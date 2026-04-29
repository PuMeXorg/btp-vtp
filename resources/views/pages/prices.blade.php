@extends('layouts.app')

@section('title', 'Цены и расчёт стоимости')
@section('description', 'Расчёт стоимости БТП, насосных станций, проектирования, автоматизации ИТП и ЦТП.')

@section('content')

<section class="py-16 bg-white">
    <div class="container mx-auto max-w-7xl px-4">

        <nav class="text-sm text-gray-400 mb-8">
            <a href="{{ route('home') }}" class="hover:text-primary">Главная</a>
            <span class="mx-2">/</span>
            <span class="text-gray-600">Цены</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">

            {{-- ЛЕВАЯ ЧАСТЬ --}}
            <div>
                <span class="text-primary font-semibold text-sm uppercase tracking-widest">Калькулятор</span>

                <h1 class="text-4xl md:text-5xl font-bold mt-4 mb-6 leading-tight">
                    Рассчитать стоимость под ваш объект
                </h1>

                <p class="text-gray-600 text-lg leading-relaxed mb-8">
                    Заполните форму — инженер изучит вводные и подготовит предварительный расчёт.
                    Чем подробнее вы опишете объект, тем точнее будет оценка.
                </p>

                <div class="space-y-4 mb-10">
                    @foreach([
                        'Подберём подходящее техническое решение',
                        'Учтём назначение и параметры объекта',
                        'Сориентируем по бюджету и срокам',
                        'Подскажем, какие данные нужны для точного расчёта',
                    ] as $item)
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-red-100 text-primary flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-check text-sm"></i>
                            </div>
                            <span class="text-gray-700 font-medium">{{ $item }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100">
                        <div class="text-3xl font-bold text-primary mb-1">15 мин</div>
                        <div class="text-sm text-gray-500">среднее время первичного ответа</div>
                    </div>

                    <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100">
                        <div class="text-3xl font-bold text-primary mb-1">4+</div>
                        <div class="text-sm text-gray-500">основных направления для расчёта</div>
                    </div>
                </div>
            </div>

            {{-- ФОРМА --}}
            <div class="bg-gray-50 rounded-3xl p-6 md:p-8 border border-gray-100 shadow-xl">
                <h2 class="text-2xl font-bold mb-2">Параметры для расчёта</h2>
                <p class="text-gray-500 mb-6">
                    Заполните форму, и мы свяжемся с вами для уточнения деталей.
                </p>

                <form id="priceCalcForm" action="{{ route('lead.order') }}" method="POST" class="space-y-5">
                    @csrf
                    <input type="hidden" name="source_url" value="{{ url()->current() }}">
                    <input type="hidden" name="form_type" value="Калькулятор стоимости">

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Что нужно рассчитать?</label>
                        <select name="direction"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary bg-white">
                            <option value="">Выберите направление</option>
                            <option value="БТП">БТП</option>
                            <option value="Насосные станции">Насосные станции</option>
                            <option value="Проектирование">Проектирование</option>
                            <option value="Проектирование внутренних инженерных систем">Проектирование внутренних инженерных систем</option>
                            <option value="Автоматизация ИТП и ЦТП">Автоматизация ИТП и ЦТП</option>
                            <option value="Пусконаладка">Пусконаладка</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Тип объекта</label>
                        <select name="object_type"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary bg-white">
                            <option value="">Выберите тип объекта</option>
                            <option value="Управляющая компания">Управляющая компания</option>
                            <option value="Застройщик">Застройщик</option>
                            <option value="Подрядчик">Подрядчик</option>
                            <option value="Промышленный объект">Промышленный объект</option>
                            <option value="Коммерческая недвижимость">Коммерческая недвижимость</option>
                            <option value="Госзаказ / тендер">Госзаказ / тендер</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Мощность / параметры</label>
                            <input type="text" name="power" placeholder="Например: 1,5 МВт"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Город / регион</label>
                            <input type="text" name="city" placeholder="Например: Москва"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Комментарий по объекту</label>
                        <textarea name="comment" rows="4"
                                  placeholder="Опишите задачу, объект, сроки, требования к оборудованию или автоматизации"
                                  class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary resize-none"></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Ваше имя</label>
                            <input type="text" name="name" required placeholder="Имя"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Телефон</label>
                            <input type="tel" name="phone" required placeholder="+7..."
                                   class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" placeholder="email@example.ru"
                               class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>

                    <button type="button"
                            onclick="submitForm('priceCalcForm','{{ route('lead.order') }}','price-calc-success')"
                            class="w-full bg-primary hover:bg-primary-dark text-white py-4 rounded-xl font-bold text-lg transition shadow-lg">
                        Отправить на расчёт
                    </button>
                </form>

                <div id="price-calc-success" class="hidden text-center py-10">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-check text-green-500 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Заявка отправлена!</h3>
                    <p class="text-gray-500">Мы свяжемся с вами и уточним детали для расчёта.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ОРИЕНТИРЫ ПО СТОИМОСТИ --}}
<section class="py-20 bg-gray-50">
    <div class="container mx-auto max-w-7xl px-4">
        <div class="text-center mb-12">
            <span class="text-primary font-semibold text-sm uppercase tracking-widest">Ориентиры</span>
            <h2 class="text-4xl font-bold mt-2 mb-4">Базовые цены</h2>
            <p class="text-gray-500 max-w-2xl mx-auto">
                Итоговая стоимость зависит от параметров объекта, комплектации, автоматики и требований заказчика.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
                ['title' => 'БТП', 'price' => 'от 800 000 ₽', 'desc' => 'Блочные тепловые пункты под параметры объекта'],
                ['title' => 'Насосные станции', 'price' => 'от 300 000 ₽', 'desc' => 'Повысительные, пожарные и канализационные решения'],
                ['title' => 'Проектирование', 'price' => 'по расчёту', 'desc' => 'Проектные решения под задачу заказчика'],
                ['title' => 'Проектирование внутрянки', 'price' => 'от 210 000 ₽', 'desc' => 'Внутренние инженерные системы объекта'],
            ] as $item)
                <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-xl transition">
                    <h3 class="text-xl font-bold mb-3">{{ $item['title'] }}</h3>
                    <div class="text-2xl font-bold text-primary mb-3">{{ $item['price'] }}</div>
                    <p class="text-gray-500 text-sm leading-relaxed">{{ $item['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ЧТО ВЛИЯЕТ НА СТОИМОСТЬ --}}
<section class="py-20 bg-white">
    <div class="container mx-auto max-w-7xl px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <span class="text-primary font-semibold text-sm uppercase tracking-widest">Факторы цены</span>
                <h2 class="text-4xl font-bold mt-2 mb-6">От чего зависит итоговая стоимость</h2>
                <p class="text-gray-600 text-lg leading-relaxed">
                    Для точной оценки важно понимать назначение объекта, технические параметры,
                    требования к автоматизации, комплектации и срокам.
                </p>
            </div>

            <div class="space-y-4">
                @foreach([
                    'Тип объекта и его назначение',
                    'Тепловая нагрузка или производительность',
                    'Требования к автоматизации и диспетчеризации',
                    'Комплектация оборудования и производители',
                    'Необходимость проектирования и документации',
                    'Сроки поставки и особенности объекта',
                ] as $factor)
                    <div class="flex items-center gap-4 bg-gray-50 border border-gray-100 rounded-2xl p-5">
                        <div class="w-10 h-10 rounded-xl bg-red-100 text-primary flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <div class="font-semibold text-gray-800">{{ $factor }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-20 bg-gray-950 relative overflow-hidden">
    <div class="absolute inset-0 opacity-40">
        <div class="absolute -top-20 -right-20 w-[420px] h-[420px] bg-red-700 rounded-full blur-3xl"></div>
    </div>

    <div class="container mx-auto max-w-7xl px-4 relative z-10">
        <div class="bg-gradient-to-br from-gray-900 via-gray-900 to-red-950 border border-white/10 rounded-3xl p-8 md:p-12 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Нужна точная стоимость?
            </h2>
            <p class="text-gray-300 text-lg max-w-2xl mx-auto mb-8">
                Оставьте заявку или позвоните — уточним параметры и подготовим расчёт под ваш объект.
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('contacts') }}"
                   class="inline-flex items-center justify-center gap-2 bg-primary hover:bg-primary-dark text-white px-8 py-4 rounded-xl font-bold transition">
                    Оставить заявку
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

                <a href="tel:{{ preg_replace('/[^+\d]/', '', $regionPhone) }}"
                   class="inline-flex items-center justify-center gap-2 border-2 border-white/25 text-white hover:bg-white/10 px-8 py-4 rounded-xl font-bold transition">
                    <i class="fa-solid fa-phone"></i>
                    Позвонить
                </a>
            </div>
        </div>
    </div>
</section>

@endsection