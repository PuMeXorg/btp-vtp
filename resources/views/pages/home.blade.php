@extends('layouts.app')

@section('title', 'Цены на БТП, насосные станции и проектирование')
@section('description', 'Базовые цены на БТП, насосные станции, проектирование и внутренние инженерные системы. Оставьте заявку на расчёт стоимости под ваш объект.')

@section('content')

{{-- HERO --}}
<section class="relative overflow-hidden bg-gray-950 py-20 md:py-28">
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-gradient-to-br from-gray-950 via-gray-900 to-red-950"></div>
        <div class="absolute right-0 top-0 w-[520px] h-[520px] bg-primary/25 rounded-full blur-3xl"></div>
        <div class="absolute left-0 bottom-0 w-[420px] h-[420px] bg-white/5 rounded-full blur-3xl"></div>
    </div>

    <div class="container mx-auto max-w-7xl px-4 relative z-10">
        <div class="max-w-4xl">
            <span class="inline-flex items-center gap-2 bg-primary/15 border border-primary/35 text-red-100 rounded-full px-4 py-2 text-sm font-semibold mb-6">
                <i class="fa-solid fa-calculator text-primary"></i>
                Расчёт стоимости под объект
            </span>

            <h1 class="text-4xl md:text-6xl font-bold text-white leading-tight mb-6">
                Цены на БТП, насосные станции и проектирование
            </h1>

            <p class="text-lg md:text-xl text-gray-300 leading-relaxed max-w-3xl">
                Укажите параметры объекта — мы подготовим предварительный расчёт стоимости и подскажем оптимальное решение под ваши задачи.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 mt-8">
                <a href="#calculator"
                   class="inline-flex items-center justify-center gap-2 bg-primary hover:bg-primary-dark text-white px-8 py-4 rounded-xl font-bold text-lg transition shadow-lg">
                    Рассчитать стоимость
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

                <a href="{{ route('contacts') }}"
                   class="inline-flex items-center justify-center gap-2 border-2 border-white/25 text-white hover:border-white hover:bg-white/10 px-8 py-4 rounded-xl font-bold text-lg transition">
                    Связаться с нами
                </a>
            </div>
        </div>
    </div>
</section>

{{-- БАЗОВЫЕ ЦЕНЫ --}}
<section class="py-20 bg-white">
    <div class="container mx-auto max-w-7xl px-4">
        <div class="text-center mb-14">
            <span class="text-primary font-semibold text-sm uppercase tracking-widest">Базовые ориентиры</span>
            <h2 class="text-4xl font-bold mt-2 mb-4">Стоимость основных направлений</h2>
            <p class="text-gray-500 max-w-3xl mx-auto">
                Ниже указаны стартовые цены. Итоговая стоимость зависит от состава оборудования, мощности, требований к автоматизации и особенностей объекта.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
                [
                    'icon' => 'fa-industry',
                    'title' => 'БТП',
                    'price' => 'от 800 000 ₽',
                    'desc' => 'Блочные тепловые пункты под задачи объекта.'
                ],
                [
                    'icon' => 'fa-water',
                    'title' => 'Насосные станции',
                    'price' => 'от 300 000 ₽',
                    'desc' => 'Повысительные, пожарные и канализационные насосные станции.'
                ],
                [
                    'icon' => 'fa-drafting-compass',
                    'title' => 'Проектирование',
                    'price' => 'по расчёту',
                    'desc' => 'Проектная документация под требования объекта.'
                ],
                [
                    'icon' => 'fa-building',
                    'title' => 'Внутренние системы',
                    'price' => 'от 210 000 ₽',
                    'desc' => 'Проектирование внутренних инженерных систем.'
                ],
            ] as $item)
                <div class="group bg-gray-50 rounded-2xl p-6 border border-gray-100 hover:border-primary/30 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 rounded-2xl bg-primary/10 flex items-center justify-center mb-5 group-hover:bg-primary transition">
                        <i class="fa-solid {{ $item['icon'] }} text-primary text-2xl group-hover:text-white transition"></i>
                    </div>

                    <h3 class="text-xl font-bold mb-2">{{ $item['title'] }}</h3>

                    <div class="text-2xl font-bold text-primary mb-3">
                        {{ $item['price'] }}
                    </div>

                    <p class="text-gray-500 text-sm leading-relaxed">
                        {{ $item['desc'] }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ВАЖНО --}}
<section class="py-10 bg-gray-50">
    <div class="container mx-auto max-w-7xl px-4">
        <div class="bg-white border border-gray-100 rounded-2xl p-6 md:p-8 shadow-sm">
            <div class="flex flex-col md:flex-row gap-5">
                <div class="w-14 h-14 rounded-2xl bg-primary/10 flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid fa-circle-info text-primary text-2xl"></i>
                </div>

                <div>
                    <h2 class="text-2xl font-bold mb-3">Почему цена рассчитывается индивидуально</h2>
                    <p class="text-gray-600 leading-relaxed">
                        БТП, насосные станции и инженерное проектирование нельзя корректно посчитать только по названию услуги.
                        На стоимость влияет мощность, комплектация, автоматика, производители оборудования, требования объекта,
                        сроки поставки и объём проектной документации. Поэтому мы даём базовые ориентиры и готовим точный расчёт после уточнения параметров.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- КАЛЬКУЛЯТОР / ЗАЯВКА --}}
<section id="calculator" class="py-20 bg-white">
    <div class="container mx-auto max-w-7xl px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">

            {{-- Левая часть --}}
            <div>
                <span class="text-primary font-semibold text-sm uppercase tracking-widest">Калькулятор</span>

                <h2 class="text-4xl font-bold mt-2 mb-5">
                    Рассчитать стоимость под ваш объект
                </h2>

                <p class="text-gray-600 text-lg leading-relaxed mb-8">
                    Заполните форму — инженер изучит вводные и подготовит предварительный расчёт. 
                    Чем подробнее вы опишете объект, тем точнее будет оценка.
                </p>

                <div class="space-y-4">
                    @foreach([
                        'Подберём подходящее техническое решение',
                        'Учтём назначение и параметры объекта',
                        'Сориентируем по бюджету и срокам',
                        'Подскажем, какие данные нужны для точного расчёта',
                    ] as $benefit)
                        <div class="flex items-start gap-3">
                            <div class="w-7 h-7 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i class="fa-solid fa-check text-primary text-sm"></i>
                            </div>
                            <span class="text-gray-700">{{ $benefit }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-gray-50 rounded-2xl p-5 border border-gray-100">
                        <div class="text-3xl font-bold text-primary mb-1">15 мин</div>
                        <div class="text-sm text-gray-500">среднее время первичного ответа</div>
                    </div>

                    <div class="bg-gray-50 rounded-2xl p-5 border border-gray-100">
                        <div class="text-3xl font-bold text-primary mb-1">4+</div>
                        <div class="text-sm text-gray-500">основных направления для расчёта</div>
                    </div>
                </div>
            </div>

            {{-- Форма --}}
            <div class="bg-gray-50 rounded-3xl p-6 md:p-8 border border-gray-100 shadow-xl">
                <h3 class="text-2xl font-bold mb-2">Параметры для расчёта</h3>
                <p class="text-gray-500 text-sm mb-6">
                    Заполните форму, и мы свяжемся с вами для уточнения деталей.
                </p>

                <form id="priceCalcForm" action="{{ route('lead.order') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="source_url" value="{{ url()->current() }}#calculator">

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Что нужно рассчитать?</label>
                        <select name="service" required
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-white focus:outline-none focus:ring-2 focus:ring-primary">
                            <option value="">Выберите направление</option>
                            <option value="БТП">БТП</option>
                            <option value="Насосная станция">Насосная станция</option>
                            <option value="ИТП / ЦТП">ИТП / ЦТП</option>
                            <option value="Проектирование">Проектирование</option>
                            <option value="Проектирование внутренних инженерных систем">Проектирование внутренних инженерных систем</option>
                            <option value="Производство электрощитового оборудования">Производство электрощитового оборудования</option>
                            <option value="Автоматизация ИТП / ЦТП">Автоматизация ИТП / ЦТП</option>
                            <option value="Другое">Другое</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Тип объекта</label>
                        <select name="object_type"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-white focus:outline-none focus:ring-2 focus:ring-primary">
                            <option value="">Выберите тип объекта</option>
                            <option value="Жилой комплекс">Жилой комплекс</option>
                            <option value="Коммерческая недвижимость">Коммерческая недвижимость</option>
                            <option value="Промышленный объект">Промышленный объект</option>
                            <option value="Государственный / тендерный объект">Государственный / тендерный объект</option>
                            <option value="Управляющая компания">Управляющая компания</option>
                            <option value="Другое">Другое</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Мощность / параметры</label>
                            <input type="text" name="power" placeholder="Например: 1,5 МВт"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-white focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Город / регион</label>
                            <input type="text" name="city" placeholder="Например: Москва"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-white focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Комментарий по объекту</label>
                        <textarea name="comment" rows="4" placeholder="Опишите задачу, объект, сроки, требования к оборудованию или автоматизации"
                                  class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-white focus:outline-none focus:ring-2 focus:ring-primary resize-none"></textarea>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Ваше имя</label>
                            <input type="text" name="name" required placeholder="Имя"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-white focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Телефон</label>
                            <input type="tel" name="phone" required placeholder="+7..."
                                   class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-white focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" placeholder="email@example.ru"
                               class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-white focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>

                    <button type="button"
                            onclick="submitForm('priceCalcForm','{{ route('lead.order') }}','price-calc-success')"
                            class="w-full bg-primary hover:bg-primary-dark text-white py-4 rounded-xl font-bold text-lg transition shadow-lg">
                        Отправить на расчёт
                    </button>

                    <p class="text-xs text-gray-400 text-center">
                        Нажимая кнопку, вы соглашаетесь с политикой конфиденциальности.
                    </p>
                </form>

                <div id="price-calc-success" class="hidden text-center py-10">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-check text-green-500 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Заявка отправлена!</h3>
                    <p class="text-gray-500">Наш специалист свяжется с вами в ближайшее время.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ЧТО ВЛИЯЕТ НА СТОИМОСТЬ --}}
<section class="py-20 bg-gray-50">
    <div class="container mx-auto max-w-7xl px-4">
        <div class="text-center mb-14">
            <span class="text-primary font-semibold text-sm uppercase tracking-widest">Факторы стоимости</span>
            <h2 class="text-4xl font-bold mt-2 mb-4">Что влияет на итоговую цену</h2>
            <p class="text-gray-500 max-w-3xl mx-auto">
                Стоимость формируется не только из оборудования. Важно учитывать проектные требования, автоматику, условия объекта и комплектацию.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach([
                [
                    'icon' => 'fa-gauge-high',
                    'title' => 'Мощность и производительность',
                    'desc' => 'Чем выше нагрузка и требования к производительности, тем больше состав оборудования.'
                ],
                [
                    'icon' => 'fa-microchip',
                    'title' => 'Автоматизация',
                    'desc' => 'Контроллеры, диспетчеризация, сценарии управления и требования к мониторингу влияют на бюджет.'
                ],
                [
                    'icon' => 'fa-screwdriver-wrench',
                    'title' => 'Комплектация',
                    'desc' => 'Итоговая цена зависит от насосов, теплообменников, шкафов, датчиков, арматуры и прочих узлов.'
                ],
                [
                    'icon' => 'fa-file-lines',
                    'title' => 'Проектная документация',
                    'desc' => 'Объём документации и требования к согласованию влияют на сроки и стоимость работ.'
                ],
                [
                    'icon' => 'fa-truck-fast',
                    'title' => 'Сроки и поставка',
                    'desc' => 'Срочные поставки и нестандартные позиции могут менять итоговый бюджет проекта.'
                ],
                [
                    'icon' => 'fa-building-circle-check',
                    'title' => 'Особенности объекта',
                    'desc' => 'Тип здания, инженерная инфраструктура и условия размещения оборудования учитываются при расчёте.'
                ],
            ] as $item)
                <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-lg transition">
                    <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center mb-5">
                        <i class="fa-solid {{ $item['icon'] }} text-primary text-xl"></i>
                    </div>

                    <h3 class="text-lg font-bold mb-2">{{ $item['title'] }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">{{ $item['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-20 bg-white">
    <div class="container mx-auto max-w-7xl px-4">
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-gray-950 via-gray-900 to-red-950 p-8 md:p-12 shadow-2xl">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_80%_20%,rgba(204,0,0,0.35),transparent_35%)]"></div>

            <div class="relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
                <div>
                    <h2 class="text-3xl md:text-5xl font-bold text-white leading-tight mb-5">
                        Нужен точный расчёт по вашему объекту?
                    </h2>

                    <p class="text-gray-300 text-lg leading-relaxed">
                        Оставьте заявку — уточним параметры и подготовим коммерческое предложение.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row lg:justify-end gap-4">
                    <a href="#calculator"
                       class="inline-flex items-center justify-center gap-2 bg-primary hover:bg-primary-dark text-white px-8 py-4 rounded-xl font-bold text-lg transition shadow-lg">
                        Рассчитать стоимость
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>

                    <a href="tel:{{ preg_replace('/[^+\d]/', '', $regionPhone) }}"
                       class="inline-flex items-center justify-center gap-2 border-2 border-white/25 text-white hover:border-white hover:bg-white/10 px-8 py-4 rounded-xl font-bold text-lg transition">
                        <i class="fa-solid fa-phone"></i>
                        Позвонить
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection