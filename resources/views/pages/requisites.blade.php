@extends('layouts.app')

@section('title', 'Реквизиты')
@section('description', 'Реквизиты ООО «ВТП Инжиниринг» — ИНН, КПП, расчётный счёт, банковские реквизиты')

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
                <h2 class="text-white font-bold text-lg">ООО «ВТП Инжиниринг»</h2>
            </div>

            <div class="divide-y divide-gray-100">

                <div class="grid grid-cols-2 px-6 py-4 gap-4">
                    <span class="text-sm text-gray-500 font-medium">Наименование</span>
                    <span class="text-sm text-gray-800 font-semibold">ООО «ВТП Инжиниринг»</span>
                </div>

                <div class="grid grid-cols-2 px-6 py-4 gap-4">
                    <span class="text-sm text-gray-500 font-medium">Юридический адрес</span>
                    <span class="text-sm text-gray-800">123376, г. Москва, ул. Красная Пресня, д. 28, этаж/офис 3/2, помещ./ком. II/5</span>
                </div>

                <div class="grid grid-cols-2 px-6 py-4 gap-4">
                    <span class="text-sm text-gray-500 font-medium">Фактический адрес</span>
                    <span class="text-sm text-gray-800">123376, г. Москва, ул. Красная Пресня, д. 28, этаж/офис 3/2, помещ./ком. II/5</span>
                </div>

                <div class="grid grid-cols-2 px-6 py-4 gap-4">
                    <span class="text-sm text-gray-500 font-medium">ИНН / КПП</span>
                    <span class="text-sm text-gray-800 font-mono">7721832858 / 770301001</span>
                </div>

                <div class="grid grid-cols-2 px-6 py-4 gap-4">
                    <span class="text-sm text-gray-500 font-medium">ОГРН</span>
                    <span class="text-sm text-gray-800 font-mono">1147746543966</span>
                </div>

                <div class="grid grid-cols-2 px-6 py-4 gap-4">
                    <span class="text-sm text-gray-500 font-medium">Расчётный счёт</span>
                    <span class="text-sm text-gray-800 font-mono">40702810400000045616</span>
                </div>

                <div class="grid grid-cols-2 px-6 py-4 gap-4">
                    <span class="text-sm text-gray-500 font-medium">Корреспондентский счёт</span>
                    <span class="text-sm text-gray-800 font-mono">30101810145250000411</span>
                </div>

                <div class="grid grid-cols-2 px-6 py-4 gap-4">
                    <span class="text-sm text-gray-500 font-medium">Банк</span>
                    <span class="text-sm text-gray-800">ФИЛИАЛ «ЦЕНТРАЛЬНЫЙ» БАНКА ВТБ (ПАО) г. Москва</span>
                </div>

                <div class="grid grid-cols-2 px-6 py-4 gap-4">
                    <span class="text-sm text-gray-500 font-medium">БИК</span>
                    <span class="text-sm text-gray-800 font-mono">044525411</span>
                </div>

                <div class="grid grid-cols-2 px-6 py-4 gap-4">
                    <span class="text-sm text-gray-500 font-medium">ОКТМО</span>
                    <span class="text-sm text-gray-800 font-mono">45394000</span>
                </div>

                <div class="grid grid-cols-2 px-6 py-4 gap-4">
                    <span class="text-sm text-gray-500 font-medium">ОКОПФ</span>
                    <span class="text-sm text-gray-800 font-mono">12300</span>
                </div>

                <div class="grid grid-cols-2 px-6 py-4 gap-4">
                    <span class="text-sm text-gray-500 font-medium">ОКВЭД</span>
                    <span class="text-sm text-gray-800">51.54, 45.2, 45.3, 51.43, 51.53</span>
                </div>

                <div class="grid grid-cols-2 px-6 py-4 gap-4">
                    <span class="text-sm text-gray-500 font-medium">Телефон</span>
                    <span class="text-sm text-gray-800">
                        <a href="tel:84957922872" class="hover:text-primary transition">8 (495) 792-28-72</a>
                    </span>
                </div>

                <div class="grid grid-cols-2 px-6 py-4 gap-4">
                    <span class="text-sm text-gray-500 font-medium">Генеральный директор</span>
                    <span class="text-sm text-gray-800">Малютин А.В.</span>
                </div>

                <div class="grid grid-cols-2 px-6 py-4 gap-4">
                    <span class="text-sm text-gray-500 font-medium">Главный бухгалтер</span>
                    <span class="text-sm text-gray-800">Малютин А.В.</span>
                </div>

            </div>
        </div>

    </div>
</section>

@endsection
