{{-- HERO --}}
<section class="relative overflow-hidden bg-[#071327] text-white">
    {{-- Фон --}}
    <div class="absolute inset-0 bg-gradient-to-r from-[#071327] via-[#071327]/95 to-[#0f4f91]/80"></div>
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_85%_50%,rgba(37,127,230,0.45),transparent_36%)]"></div>

    {{-- Картинка из админки, если загружена --}}
    @if($hero?->image)
        <img src="{{ asset('storage/' . $hero->image) }}"
             alt="{{ $hero->title }}"
             class="absolute inset-0 w-full h-full object-cover opacity-20">
    @endif

    <div class="container mx-auto max-w-7xl px-4 relative z-10">
        <div class="min-h-[620px] grid grid-cols-1 lg:grid-cols-[1fr_420px] gap-10 items-center py-20">

            {{-- Левая часть --}}
            <div class="max-w-4xl">
                <div class="inline-flex items-center gap-2 bg-primary/20 border border-primary/40 text-blue-100 rounded-full px-5 py-2 text-sm font-semibold mb-8">
                    <i class="fa-solid fa-circle-check text-primary"></i>
                    Более 500 объектов сдано в эксплуатацию
                </div>

                <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold text-white leading-[1.05] mb-7 tracking-tight">
                    {!! nl2br(e($hero?->title ?: 'Монтаж тепловых пунктов под ключ')) !!}
                    <span class="block text-primary">
                        {{ $hero?->settings['accent_title'] ?? 'от 40 дней' }}
                    </span>
                </h1>

                <p class="text-lg md:text-2xl text-gray-200 mb-7 leading-relaxed max-w-3xl">
                    {!! nl2br(e($hero?->subtitle ?: 'Проектирование, монтаж и сдача ИТП, ЦТП и УУТЭ в ПАО «МОЭК» и МТУ Ростехнадзора')) !!}
                </p>

                {{-- Зеленые преимущества под текстом --}}
                <div class="flex flex-wrap gap-x-6 gap-y-3 text-green-400 font-medium mb-9">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-check"></i>
                        <span>Ускоренное согласование в МОЭК</span>
                    </div>

                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-check"></i>
                        <span>Собственное производство</span>
                    </div>

                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-check"></i>
                        <span>Гарантия на работы</span>
                    </div>
                </div>

                {{-- Кнопки --}}
                <div class="flex flex-wrap gap-4">
                    <a href="{{ $hero?->button_url ?: route('contacts') }}"
                       class="inline-flex items-center gap-3 bg-primary hover:bg-primary-dark text-white px-8 py-4 rounded-xl font-bold text-lg transition shadow-lg">
                        <i class="fa-solid fa-id-card"></i>
                        {{ $hero?->button_text ?: 'Получить расчёт бесплатно' }}
                    </a>

                    <a href="{{ route('portfolio') }}"
                       class="inline-flex items-center gap-3 border-2 border-white/30 text-white hover:border-white hover:bg-white/10 px-8 py-4 rounded-xl font-bold text-lg transition">
                        <i class="fa-solid fa-eye"></i>
                        Наши проекты
                    </a>
                </div>
            </div>

            {{-- Правая часть со статистикой --}}
            <div class="hidden lg:flex items-end justify-end h-full pb-10">
                <div class="flex gap-5">
                    <div class="w-28 h-28 rounded-xl bg-white/10 border border-white/20 backdrop-blur flex flex-col items-center justify-center text-center">
                        <div class="text-3xl font-extrabold">500+</div>
                        <div class="text-sm text-gray-200 mt-1">объектов</div>
                    </div>

                    <div class="w-28 h-28 rounded-xl bg-white/10 border border-white/20 backdrop-blur flex flex-col items-center justify-center text-center">
                        <div class="text-3xl font-extrabold">15</div>
                        <div class="text-sm text-gray-200 mt-1">лет опыта</div>
                    </div>

                    <div class="w-28 h-28 rounded-xl bg-white/10 border border-white/20 backdrop-blur flex flex-col items-center justify-center text-center">
                        <div class="text-3xl font-extrabold">40</div>
                        <div class="text-sm text-gray-200 mt-1">дней срок</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>