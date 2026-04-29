@extends('layouts.app')

@section('title', 'Сертификаты ВТП')
@section('description', 'Сертификаты ВТП Инжиниринг. Документы, подтверждающие качество и соответствие решений.')

@section('content')

@php
    $certificates = [
        [
            'title' => 'Сертификат ВТП №1',
            'file' => 'certificates/sertifikat-vtp-1.pdf',
        ],
        [
            'title' => 'Сертификат ВТП №2',
            'file' => 'certificates/sertifikat-vtp-2.pdf',
        ],
        [
            'title' => 'Сертификат ВТП №3',
            'file' => 'certificates/sertifikat-vtp-3.pdf',
        ],
    ];
@endphp

<section class="bg-gray-50 py-12">
    <div class="container mx-auto max-w-7xl px-4">
        <nav class="text-sm text-gray-400 mb-6">
            <a href="{{ route('home') }}" class="hover:text-primary">Главная</a>
            <span class="mx-2">/</span>
            <a href="{{ route('about') }}" class="hover:text-primary">О компании</a>
            <span class="mx-2">/</span>
            <span class="text-gray-600">Сертификаты ВТП</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
            <div>
                <span class="text-primary font-semibold text-sm uppercase tracking-widest">
                    Документы
                </span>

                <h1 class="text-4xl md:text-5xl font-bold mt-3 mb-5 text-gray-900">
                    Сертификаты ВТП
                </h1>

                <p class="text-lg text-gray-600 leading-relaxed max-w-2xl">
                    Документы, подтверждающие качество, соответствие и надёжность решений ВТП Инжиниринг.
                    Вы можете открыть сертификат в браузере или скачать оригинальный PDF-файл.
                </p>
            </div>

            <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm">
                <div class="grid grid-cols-2 gap-4">
                    <div class="rounded-2xl bg-red-50 p-5">
                        <div class="text-3xl font-bold text-primary">{{ count($certificates) }}</div>
                        <div class="text-sm text-gray-500">документа</div>
                    </div>

                    <div class="rounded-2xl bg-gray-50 p-5">
                        <div class="text-3xl font-bold text-gray-900">PDF</div>
                        <div class="text-sm text-gray-500">формат файлов</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-16 bg-white" x-data="{ open: false, pdfUrl: '', pdfTitle: '' }">
    <div class="container mx-auto max-w-7xl px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($certificates as $certificate)
                @php
                    $url = asset('storage/' . $certificate['file']);
                @endphp

                <div class="group bg-white rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl transition overflow-hidden">
                    <div class="h-56 bg-gradient-to-br from-gray-100 to-red-50 flex items-center justify-center relative">
                        <div class="absolute inset-0 opacity-40">
                            <div class="absolute top-8 right-8 w-24 h-24 bg-red-200 rounded-full blur-2xl"></div>
                            <div class="absolute bottom-8 left-8 w-24 h-24 bg-gray-300 rounded-full blur-2xl"></div>
                        </div>

                        <div class="relative z-10 w-24 h-24 rounded-3xl bg-white shadow-lg flex items-center justify-center">
                            <i class="fa-solid fa-file-pdf text-primary text-5xl"></i>
                        </div>
                    </div>

                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-3">
                            {{ $certificate['title'] }}
                        </h2>

                        <p class="text-gray-500 text-sm leading-relaxed mb-5">
                            Откройте документ для просмотра или скачайте PDF-файл на устройство.
                        </p>

                        <div class="flex flex-col sm:flex-row gap-3">
                            <button
                                type="button"
                                @click="open = true; pdfUrl = '{{ $url }}'; pdfTitle = '{{ $certificate['title'] }}'"
                                class="inline-flex items-center justify-center gap-2 bg-primary hover:bg-primary-dark text-white px-5 py-3 rounded-xl font-semibold transition">
                                <i class="fa-solid fa-eye"></i>
                                Открыть
                            </button>

                            <a href="{{ $url }}"
                               download
                               class="inline-flex items-center justify-center gap-2 border border-gray-200 hover:border-primary text-gray-700 hover:text-primary px-5 py-3 rounded-xl font-semibold transition">
                                <i class="fa-solid fa-download"></i>
                                Скачать
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div
        x-show="open"
        x-cloak
        class="fixed inset-0 z-[100] bg-black/70 backdrop-blur-sm flex items-center justify-center p-4"
        @click.self="open = false"
    >
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-6xl h-[85vh] overflow-hidden flex flex-col">
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <h3 class="font-bold text-gray-900" x-text="pdfTitle"></h3>

                <button
                    type="button"
                    @click="open = false"
                    class="w-9 h-9 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center transition"
                >
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <iframe
                :src="pdfUrl"
                class="w-full flex-1"
                frameborder="0"
            ></iframe>
        </div>
    </div>
</section>

@endsection
