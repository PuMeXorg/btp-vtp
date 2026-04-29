@extends('layouts.app')

@section('title', 'Сертификаты ВТП')
@section('description', 'Сертификаты и документы ВТП Инжиниринг.')

@section('content')

<section class="bg-gray-50 py-16 md:py-20">
    <div class="container mx-auto max-w-7xl px-4">
        <nav class="text-sm text-gray-400 mb-8">
            <a href="{{ route('home') }}" class="hover:text-primary">Главная</a>
            <span class="mx-2">/</span>
            <a href="{{ route('about') }}" class="hover:text-primary">О компании</a>
            <span class="mx-2">/</span>
            <span class="text-gray-600">Сертификаты ВТП</span>
        </nav>

        <div class="max-w-3xl">
            <div class="text-primary font-semibold uppercase tracking-[0.2em] text-sm mb-4">
                Документы
            </div>

            <h1 class="text-4xl md:text-6xl font-bold text-gray-900 leading-tight mb-6">
                Сертификаты ВТП
            </h1>

            <p class="text-lg md:text-xl text-gray-600 leading-relaxed">
                Документы, подтверждающие качество, соответствие и надёжность решений ВТП Инжиниринг.
                Вы можете открыть сертификат в новой вкладке или скачать оригинальный PDF-файл.
            </p>
        </div>
    </div>
</section>

<section class="py-14 md:py-20 bg-white">
    <div class="container mx-auto max-w-7xl px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
            @foreach($certificates as $certificate)
                <div class="group bg-white rounded-3xl overflow-hidden border border-gray-200 shadow-sm hover:shadow-xl transition-all duration-300">

                    <a href="{{ asset($certificate['file']) }}"
                       target="_blank"
                       class="block bg-gray-100 aspect-[4/5] overflow-hidden">
                        <img
                            src="{{ asset($certificate['preview']) }}"
                            alt="{{ $certificate['title'] }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                        >
                    </a>

                    <div class="p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-3">
                            {{ $certificate['title'] }}
                        </h2>

                        <p class="text-gray-600 leading-relaxed mb-6">
                            Откройте документ для просмотра или скачайте PDF-файл на устройство.
                        </p>

                        <div class="flex flex-wrap gap-3">
                            <a href="{{ asset($certificate['file']) }}"
                               target="_blank"
                               class="inline-flex items-center justify-center gap-2 bg-primary hover:bg-primary-dark text-white px-6 py-3 rounded-xl font-semibold transition">
                                <i class="fa-solid fa-eye"></i>
                                Открыть
                            </a>

                            <a href="{{ asset($certificate['file']) }}"
                               download
                               class="inline-flex items-center justify-center gap-2 border border-gray-300 text-gray-700 hover:border-primary hover:text-primary px-6 py-3 rounded-xl font-semibold transition">
                                <i class="fa-solid fa-download"></i>
                                Скачать
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
