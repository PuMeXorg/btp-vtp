@extends('layouts.app')

@section('title', 'Реквизиты')
@section('description', 'Реквизиты ООО «Инженерный комфорт» — ИНН, КПП, ОГРН, юридический адрес.')

@section('content')

<section class="py-12">
    <div class="container mx-auto max-w-7xl px-4">

        {{-- Breadcrumbs --}}
        <nav class="text-sm text-gray-500 mb-6 flex items-center gap-2">
            <a href="{{ route('home') }}" class="hover:text-primary transition">Главная</a>
            <span>/</span>
            <a href="{{ route('about') }}" class="hover:text-primary transition">О компании</a>
            <span>/</span>
            <span class="text-gray-800 font-medium">Реквизиты</span>
        </nav>

        <h1 class="text-3xl font-bold text-gray-900 mb-8">Реквизиты</h1>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden max-w-2xl">
            <div class="bg-primary px-6 py-4">
                <h2 class="text-white font-bold text-lg">ООО «Инженерный комфорт»</h2>
            </div>

            <div class="divide-y divide-gray-100">

                <div class="grid grid-cols-2 px-6 py-4 gap-4">
                    <span class="text-sm text-gray-500 font-medium">Наименование</span>
                    <span class="text-sm text-gray-800 font-semibold">ООО «Инженерный комфорт»</span>
                </div>

                <div class="grid grid-cols-2 px-6 py-4 gap-4">
                    <span class="text-sm text-gray-500 font-medium">Юридический адрес</span>
                    <span class="text-sm text-gray-800">г. Москва, ул. Дорожная, д. 60Ас1</span>
                </div>

                <div class="grid grid-cols-2 px-6 py-4 gap-4">
                    <span class="text-sm text-gray-500 font-medium">ИНН / КПП</span>
                    <span class="text-sm text-gray-800 font-mono">7727457522 / 772701001</span>
                </div>

                <div class="grid grid-cols-2 px-6 py-4 gap-4">
                    <span class="text-sm text-gray-500 font-medium">ОГРН</span>
                    <span class="text-sm text-gray-800 font-mono">1207700496519</span>
                </div>

                <div class="grid grid-cols-2 px-6 py-4 gap-4">
                    <span class="text-sm text-gray-500 font-medium">Банковские реквизиты</span>
                    <span class="text-sm text-gray-800">Предоставляются по запросу</span>
                </div>

            </div>
        </div>

    </div>
</section>

@endsection
