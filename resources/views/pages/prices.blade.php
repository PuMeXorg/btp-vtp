@extends('layouts.app')

@section('title', 'Цены')
@section('description', 'Предварительный расчёт стоимости БТП, насосных станций, проектирования, пусконаладки и автоматизации ИТП / ЦТП.')

@section('content')

<section class="bg-gray-50 py-14 md:py-20">
    <div class="container mx-auto max-w-7xl px-4">
        <nav class="text-sm text-gray-400 mb-8">
            <a href="{{ route('home') }}" class="hover:text-primary">Главная</a>
            <span class="mx-2">/</span>
            <span class="text-gray-600">Цены</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
            <div>
                <div class="text-primary font-semibold uppercase tracking-[0.2em] text-sm mb-4">
                    Расчёт стоимости
                </div>

                <h1 class="text-4xl md:text-6xl font-bold text-gray-900 leading-tight mb-6">
                    Цены на инженерные решения
                </h1>

                <p class="text-lg md:text-xl text-gray-600 leading-relaxed">
                    Укажите направление и параметры объекта — калькулятор покажет предварительную стоимость.
                    Итоговая цена зависит от технического задания, комплектации, мощности и условий поставки.
                </p>
            </div>

            <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm">
                <h2 class="text-2xl font-bold mb-4">Что можно рассчитать</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="rounded-2xl bg-red-50 p-5">
                        <div class="text-2xl font-bold text-primary">БТП</div>
                        <div class="text-sm text-gray-500">от 800 000 ₽</div>
                    </div>

                    <div class="rounded-2xl bg-gray-50 p-5">
                        <div class="text-2xl font-bold text-gray-900">Насосные станции</div>
                        <div class="text-sm text-gray-500">от 300 000 ₽</div>
                    </div>

                    <div class="rounded-2xl bg-gray-50 p-5">
                        <div class="text-2xl font-bold text-gray-900">Проектирование</div>
                        <div class="text-sm text-gray-500">от 210 000 ₽</div>
                    </div>

                    <div class="rounded-2xl bg-red-50 p-5">
                        <div class="text-2xl font-bold text-primary">Автоматизация</div>
                        <div class="text-sm text-gray-500">от 350 000 ₽</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-16 md:py-20 bg-white">
    <div class="container mx-auto max-w-7xl px-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

            <div class="lg:col-span-2">
                <div class="bg-white rounded-3xl border border-gray-200 shadow-sm p-6 md:p-8">
                    <div class="mb-8">
                        <div class="text-primary font-semibold uppercase tracking-[0.2em] text-sm mb-3">
                            Калькулятор
                        </div>

                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                            Предварительный расчёт
                        </h2>

                        <p class="text-gray-600 leading-relaxed">
                            Это ориентировочная стоимость. Для точного коммерческого предложения отправьте заявку -
                            инженер уточнит вводные и подготовит расчёт под ваш объект.
                        </p>
                    </div>

                    <form id="priceCalcForm" action="{{ route('lead.order') }}" method="POST" class="space-y-6">
                        <span aria-hidden="true" style="position:absolute;left:-9999px;top:-9999px;width:1px;height:1px;overflow:hidden"><input type="text" name="website" tabindex="-1" autocomplete="off" value=""></span>
                        @csrf
                        <input type="hidden" name="source_url" value="{{ url()->current() }}">
                        <input type="hidden" name="comment" id="priceCalcComment">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Что нужно рассчитать?
                                </label>

                                <select id="calcService" name="service_type" required
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">
                                    <option value="">Выберите направление</option>
                                    <option value="btp">БТП</option>
                                    <option value="nasos">Насосные станции</option>
                                    <option value="project_itp_ctp">Проектирование ИТП / ЦТП</option>
                                    <option value="project_internal">Проектирование внутренних инженерных систем</option>
                                    <option value="puskonaladka">Пусконаладка</option>
                                    <option value="automation_oven">Автоматизация — ОВЕН</option>
                                    <option value="automation_transformer">Автоматизация — Трансформер</option>
                                    <option value="automation_Ridan">Автоматизация — Ridan</option>
                                    <option value="automation_request">Автоматизация — ТЕКОН / Segnetics / другое</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Мощность / тепловая нагрузка
                                </label>

                                <select id="calcPower" name="power_range"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">
                                    <option value="">Не выбрано</option>
                                    <option value="до 1 Гкал/час">до 1 Гкал/час</option>
                                    <option value="от 1 до 5 Гкал/час">от 1 до 5 Гкал/час</option>
                                    <option value="от 5 до 10 Гкал/час">от 5 до 10 Гкал/час</option>
                                    <option value="от 10 до 15 Гкал/час">от 10 до 15 Гкал/час</option>
                                    <option value="свыше 15 Гкал/час">свыше 15 Гкал/час</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Тип объекта
                                </label>

                                <select id="calcObject" name="object_type"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">
                                    <option value="">Не выбрано</option>
                                    <option value="Жилое строительство">Жилое строительство</option>
                                    <option value="Социально-административный">Социально-административный</option>
                                    <option value="Спортивный">Спортивный</option>
                                    <option value="Промышленный">Промышленный</option>
                                    <option value="ТРЦ, БЦ">ТРЦ, БЦ</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Город / регион
                                </label>

                                <input id="calcCity" type="text" name="city" placeholder="Например: Москва"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">
                            </div>
                        </div>

                        <div class="rounded-3xl bg-gray-50 border border-gray-100 p-6">
                            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
                                <div>
                                    <div class="text-sm text-gray-500 mb-1">
                                        Предварительная стоимость
                                    </div>

                                    <div id="calcResult" class="text-4xl md:text-5xl font-bold text-primary">
                                        —
                                    </div>

                                    <div id="calcHint" class="text-sm text-gray-500 mt-2">
                                        Выберите направление для расчёта.
                                    </div>
                                </div>

                                <button type="button" onclick="calculatePrice()"
                                    class="inline-flex items-center justify-center gap-2 bg-gray-900 hover:bg-black text-white px-7 py-4 rounded-xl font-bold transition">
                                    <i class="fa-solid fa-calculator"></i>
                                    Рассчитать
                                </button>
                            </div>
                        </div>

                        <div class="border-t border-gray-100 pt-6">
                            <h3 class="text-2xl font-bold mb-4">Получить точный расчёт</h3>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                                <input type="text" name="name" required placeholder="Ваше имя"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">

                                <input type="tel" name="phone" required placeholder="Телефон"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">

                                <input type="email" name="email" placeholder="Email"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">
                            </div>

                            <textarea id="calcExtraComment" name="extra_comment" rows="3" placeholder="Комментарий: параметры объекта, сроки, особенности задачи"
                                class="w-full mt-5 border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary resize-none"></textarea>

                            <button type="button"
                                onclick="preparePriceCalcComment(); submitForm('priceCalcForm','{{ route('lead.order') }}','price-calc-success')"
                                class="mt-5 w-full md:w-auto inline-flex items-center justify-center gap-2 bg-primary hover:bg-primary-dark text-white px-8 py-4 rounded-xl font-bold text-lg transition shadow-lg">
                                Отправить заявку на расчёт
                                <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </div>
                    </form>

                    <div id="price-calc-success" class="hidden text-center py-12">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fa-solid fa-check text-green-500 text-2xl"></i>
                        </div>

                        <h3 class="text-2xl font-bold mb-2">Заявка отправлена</h3>
                        <p class="text-gray-500">Инженер свяжется с вами и подготовит точный расчёт.</p>
                    </div>
                </div>
            </div>

            <aside class="space-y-5">
                <div class="bg-gray-950 text-white rounded-3xl p-6">
                    <h3 class="text-2xl font-bold mb-3">Важно</h3>
                    <p class="text-gray-300 leading-relaxed">
                        На сайте представлены ориентировочные цены. Окончательная стоимость определяется индивидуально и зависит
                         от комплектации, мощности оборудования, типа автоматики, проектных требований и условий поставки.
                    </p>
                </div>

                <div class="bg-white rounded-3xl border border-gray-200 p-6 shadow-sm">
                    <h3 class="text-xl font-bold mb-4">В расчёт не включен монтаж</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Монтажные работы не включены в калькулятор.
                        Расчёт сфокусирован на поставке, проектировании, пусконаладке и автоматизации.
                    </p>
                </div>

                <div class="bg-red-50 rounded-3xl p-6">
                    <h3 class="text-xl font-bold mb-4">Нужна консультация?</h3>
                    <p class="text-gray-600 mb-5">
                        Оставьте заявку — подскажем, какое решение подойдёт под ваш объект.
                    </p>

                    <a href="{{ route('contacts') }}"
                        class="inline-flex items-center justify-center gap-2 bg-primary hover:bg-primary-dark text-white px-6 py-3 rounded-xl font-bold transition">
                        Связаться
                        <i class="fa-solid fa-phone"></i>
                    </a>
                </div>
            </aside>
        </div>
    </div>
</section>

<section class="py-16 bg-gray-50">
    <div class="container mx-auto max-w-7xl px-4">
        <div class="mb-10">
            <div class="text-primary font-semibold uppercase tracking-[0.2em] text-sm mb-3">
                Стоимость услуг
            </div>

            <h2 class="text-3xl md:text-4xl font-bold text-gray-900">
                В стоимость услуг входит продукция, доставка, монтаж и пусконаладка. 
                Присылайте проекты для просчета на почту <a class="text-primary" href="mailto:region@vtp-inz.ru">region@vtp-inz.ru</a>
            </h2>
        </div>

        <div class="overflow-hidden bg-white rounded-3xl border border-gray-200 shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-950 text-white">
                        <tr>
                            <th class="px-6 py-4 font-bold">Направление</th>
                            <th class="px-6 py-4 font-bold">Параметр</th>
                            <th class="px-6 py-4 font-bold">Стоимость</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        <tr>
                            <td class="px-6 py-4 font-semibold">БТП</td>
                            <td class="px-6 py-4 text-gray-600">Блочный тепловой пункт</td>
                            <td class="px-6 py-4 font-bold text-primary">от 800 000 ₽</td>
                        </tr>

                        <tr>
                            <td class="px-6 py-4 font-semibold">Насосные станции</td>
                            <td class="px-6 py-4 text-gray-600">Подбор и поставка оборудования</td>
                            <td class="px-6 py-4 font-bold text-primary">от 300 000 ₽</td>
                        </tr>

                        <tr>
                            <td class="px-6 py-4 font-semibold">Проектирование ИТП / ЦТП</td>
                            <td class="px-6 py-4 text-gray-600">до 1 Гкал/час</td>
                            <td class="px-6 py-4 font-bold text-primary">от 220 000 ₽</td>
                        </tr>

                        <tr>
                            <td class="px-6 py-4 font-semibold">Проектирование ИТП / ЦТП</td>
                            <td class="px-6 py-4 text-gray-600">от 1 до 5 Гкал/час</td>
                            <td class="px-6 py-4 font-bold text-primary">от 380 000 ₽</td>
                        </tr>

                        <tr>
                            <td class="px-6 py-4 font-semibold">Проектирование ИТП / ЦТП</td>
                            <td class="px-6 py-4 text-gray-600">от 5 до 10 Гкал/час</td>
                            <td class="px-6 py-4 font-bold text-primary">от 710 000 ₽</td>
                        </tr>

                        <tr>
                            <td class="px-6 py-4 font-semibold">Проектирование ИТП / ЦТП</td>
                            <td class="px-6 py-4 text-gray-600">от 10 до 15 Гкал/час</td>
                            <td class="px-6 py-4 font-bold text-primary">от 1 000 000 ₽</td>
                        </tr>

                        <tr>
                            <td class="px-6 py-4 font-semibold">Проектирование ИТП / ЦТП</td>
                            <td class="px-6 py-4 text-gray-600">свыше 15 Гкал/час</td>
                            <td class="px-6 py-4 font-bold text-primary">от 1 200 000 ₽</td>
                        </tr>

                        <tr>
                            <td class="px-6 py-4 font-semibold">Проектирование внутренних инженерных систем</td>
                            <td class="px-6 py-4 text-gray-600">ОВ, ВК и другие внутренние системы</td>
                            <td class="px-6 py-4 font-bold text-primary">от 210 000 ₽</td>
                        </tr>

                        <tr>
                            <td class="px-6 py-4 font-semibold">Пусконаладка</td>
                            <td class="px-6 py-4 text-gray-600">Тепловой пункт</td>
                            <td class="px-6 py-4 font-bold text-primary">от 190 000 ₽</td>
                        </tr>

                        <tr>
                            <td class="px-6 py-4 font-semibold">Автоматизация ИТП / ЦТП</td>
                            <td class="px-6 py-4 text-gray-600">ОВЕН</td>
                            <td class="px-6 py-4 font-bold text-primary">от 350 000 ₽</td>
                        </tr>

                        <tr>
                            <td class="px-6 py-4 font-semibold">Автоматизация ИТП / ЦТП</td>
                            <td class="px-6 py-4 text-gray-600">Трансформер</td>
                            <td class="px-6 py-4 font-bold text-primary">от 550 000 ₽</td>
                        </tr>

                        <tr>
                            <td class="px-6 py-4 font-semibold">Автоматизация ИТП / ЦТП</td>
                            <td class="px-6 py-4 text-gray-600">Ridan</td>
                            <td class="px-6 py-4 font-bold text-primary">от 750 000 ₽</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<script>
function formatRub(value) {
    return new Intl.NumberFormat('ru-RU').format(value) + ' ₽';
}

function getSelectedText(selectId) {
    const select = document.getElementById(selectId);

    if (!select || select.selectedIndex < 0) {
        return '';
    }

    return select.options[select.selectedIndex].text;
}

function calculatePrice() {
    const service = document.getElementById('calcService').value;
    const power = document.getElementById('calcPower').value;

    const result = document.getElementById('calcResult');
    const hint = document.getElementById('calcHint');

    let price = null;
    let text = '';

    if (service === 'btp') {
        price = 800000;
        text = 'Ориентир для БТП. Точная цена зависит от комплектации и параметров объекта.';
    }

    if (service === 'nasos') {
        price = 300000;
        text = 'Ориентир для насосной станции. Точная цена зависит от производительности и комплектации.';
    }

    if (service === 'project_internal') {
        price = 210000;
        text = 'Ориентир для проектирования внутренних инженерных систем.';
    }

    if (service === 'puskonaladka') {
        price = 190000;
        text = 'Ориентир для пусконаладки теплового пункта.';
    }

    if (service === 'automation_oven') {
        price = 350000;
        text = 'Ориентир для автоматизации на базе ОВЕН.';
    }

    if (service === 'automation_transformer') {
        price = 550000;
        text = 'Ориентир для автоматизации на базе Трансформер.';
    }

    if (service === 'automation_Ridan') {
        price = 750000;
        text = 'Ориентир для автоматизации на базе Ridan.';
    }

    if (service === 'automation_request') {
        result.textContent = 'по запросу';
        hint.textContent = 'Для ТЕКОН, Segnetics и других решений нужна индивидуальная оценка.';
        preparePriceCalcComment();
        return;
    }

    if (service === 'project_itp_ctp') {
        if (power === 'до 1 Гкал/час') {
            price = 220000;
        } else if (power === 'от 1 до 5 Гкал/час') {
            price = 380000;
        } else if (power === 'от 5 до 10 Гкал/час') {
            price = 710000;
        } else if (power === 'от 10 до 15 Гкал/час') {
            price = 1000000;
        } else if (power === 'свыше 15 Гкал/час') {
            price = 1200000;
        } else {
            result.textContent = '—';
            hint.textContent = 'Для проектирования ИТП / ЦТП выберите мощность.';
            preparePriceCalcComment();
            return;
        }

        text = 'Ориентир для проектирования ИТП / ЦТП по выбранной мощности.';
    }

    if (!price) {
        result.textContent = '—';
        hint.textContent = 'Выберите направление для расчёта.';
        preparePriceCalcComment();
        return;
    }

    result.textContent = 'от ' + formatRub(price);
    hint.textContent = text;

    preparePriceCalcComment();
}

function preparePriceCalcComment() {
    const serviceText = getSelectedText('calcService');
    const powerText = getSelectedText('calcPower');
    const objectText = getSelectedText('calcObject');
    const city = document.getElementById('calcCity').value || 'не указан';
    const extra = document.getElementById('calcExtraComment').value || 'нет';
    const result = document.getElementById('calcResult').textContent || 'не рассчитано';

    document.getElementById('priceCalcComment').value =
        'Заявка со страницы цен' + "\n" +
        'Направление: ' + serviceText + "\n" +
        'Мощность / нагрузка: ' + powerText + "\n" +
        'Тип объекта: ' + objectText + "\n" +
        'Город / регион: ' + city + "\n" +
        'Предварительная стоимость: ' + result + "\n" +
        'Комментарий: ' + extra;
}

document.addEventListener('DOMContentLoaded', function () {
    const fields = ['calcService', 'calcPower', 'calcObject', 'calcCity', 'calcExtraComment'];

    fields.forEach(function (id) {
        const field = document.getElementById(id);

        if (!field) {
            return;
        }

        field.addEventListener('change', calculatePrice);
        field.addEventListener('input', preparePriceCalcComment);
    });
});
</script>

@endsection
