@extends('layouts.app')

@section('title', 'Контакты')

@section('content')
<div class="container mx-auto max-w-7xl px-4 py-12">

    <nav class="text-sm text-gray-400 mb-6">
        <a href="{{ route('home') }}" class="hover:text-primary">Главная</a>
        <span class="mx-2">/</span>
        <span class="text-gray-600">Контакты</span>
    </nav>

    <h1 class="text-3xl font-bold mb-8">Контакты</h1>

    {{-- Переключение регионов --}}
    <div class="flex flex-wrap gap-2 mb-10">
        <form method="POST" action="{{ route('region.set') }}" class="inline">
            @csrf
            <input type="hidden" name="redirect" value="{{ route('contacts') }}">
            <button type="submit" name="region" value="default"
                class="px-4 py-2 rounded-full border text-sm font-medium transition
                    {{ !$currentRegion ? 'bg-primary text-white border-primary' : 'bg-white text-gray-600 border-gray-300 hover:border-primary hover:text-primary' }}">
                Все регионы
            </button>
        </form>
        @foreach($allRegions as $region)
        <form method="POST" action="{{ route('region.set') }}" class="inline">
            @csrf
            <input type="hidden" name="redirect" value="{{ route('contacts') }}">
            <button type="submit" name="region" value="{{ $region->slug }}"
                class="px-4 py-2 rounded-full border text-sm font-medium transition
                    {{ ($currentRegion && $currentRegion->slug === $region->slug) ? 'bg-primary text-white border-primary' : 'bg-white text-gray-600 border-gray-300 hover:border-primary hover:text-primary' }}">
                {{ $region->name }}
            </button>
        </form>
        @endforeach
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

        {{-- Контактные данные --}}
        <div>
            @if($regionName)
            <h2 class="text-xl font-bold mb-6 text-primary">{{ $regionName }}</h2>
            @endif

            <div class="space-y-6">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-xl flex-shrink-0">📞</div>
                    <div>
                        <p class="text-sm text-gray-400 mb-1">Телефон</p>
                        <a href="tel:{{ preg_replace('/[^+\d]/', '', $regionPhone) }}"
                            class="text-2xl font-bold text-gray-900 hover:text-primary transition">
                            {{ $regionPhone }}
                        </a>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-xl flex-shrink-0">✉️</div>
                    <div>
                        <p class="text-sm text-gray-400 mb-1">Email</p>
                        <a href="mailto:{{ $regionEmail }}"
                            class="text-lg font-medium text-gray-900 hover:text-primary transition">
                            {{ $regionEmail }}
                        </a>
                    </div>
                </div>

                @if($regionAddress)
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-xl flex-shrink-0">📍</div>
                    <div>
                        <p class="text-sm text-gray-400 mb-1">Адрес</p>
                        <p class="text-lg font-medium text-gray-900">{{ $regionAddress }}</p>
                    </div>
                </div>
                @endif

                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-xl flex-shrink-0">🕐</div>
                    <div>
                        <p class="text-sm text-gray-400 mb-1">Режим работы</p>
                        <p class="text-lg font-medium text-gray-900">{{ $regionHours }}</p>
                    </div>
                </div>
            </div>

            {{-- Все офисы --}}
            <div class="mt-10">
                <h3 class="font-bold text-lg mb-4">Наши офисы</h3>
                <div class="space-y-4">
                    @foreach($allRegions as $region)
                    <div class="border rounded-xl p-4 {{ ($currentRegion && $currentRegion->slug === $region->slug) ? 'border-primary bg-blue-50' : '' }}">
                        <p class="font-bold mb-1">{{ $region->name }}</p>
                        @if($region->address)
                        <p class="text-sm text-gray-600">📍 {{ $region->address }}</p>
                        @endif
                        @if($region->phone_display)
                        <p class="text-sm mt-1">
                            <a href="tel:{{ preg_replace('/[^+\d]/', '', $region->phone) }}"
                                class="text-primary font-medium">{{ $region->phone_display }}</a>
                        </p>
                        @endif
                        @if($region->email)
                        <p class="text-sm text-gray-600">
                            ✉️
                            <a href="mailto:{{ $region->email }}"
                                class="text-primary font-medium hover:underline">{{ $region->email }}</a>
                        </p>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Форма --}}
        <div>
            <div class="bg-gray-50 rounded-2xl p-8">
                <h2 class="text-xl font-bold mb-6">Написать нам</h2>
                <form id="contactForm" action="{{ route('lead.order') }}" method="POST">
                    @csrf
                    <input type="hidden" name="source_url" value="{{ url()->current() }}">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Ваше имя *</label>
                            <input type="text" name="name" required
                                class="w-full border rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Телефон *</label>
                            <input type="tel" name="phone" required
                                class="w-full border rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Email</label>
                            <input type="email" name="email"
                                class="w-full border rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Сообщение</label>
                            <textarea name="comment" rows="4"
                                class="w-full border rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-primary resize-none"></textarea>
                        </div>
                        <button type="button"
                            onclick="submitForm('contactForm', '{{ route('lead.order') }}', 'contact-success')"
                            class="w-full bg-primary hover:bg-primary-dark text-white py-3 rounded-lg font-medium transition">
                            Отправить сообщение
                        </button>
                        <p class="text-xs text-gray-400 text-center">
                            Нажимая кнопку, вы соглашаетесь с политикой конфиденциальности
                        </p>
                    </div>
                </form>
                <div id="contact-success" class="hidden text-center py-8">
                    <div class="text-green-500 text-5xl mb-3">✓</div>
                    <p class="font-semibold text-lg">Сообщение отправлено!</p>
                    <p class="text-gray-500 mt-1">Мы свяжемся с вами в ближайшее время.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
