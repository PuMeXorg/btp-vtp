<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Переименовываем родительский раздел
        DB::table('pages')->where('id', 13)->update([
            'title'      => 'Производство электрощитового оборудования',
            'updated_at' => now(),
        ]);

        $parentId = 13;

        $items = [
            [
                'slug'  => 'vvodno-raspredelitelnye-ustroystva',
                'title' => 'Вводно-распределительные устройства (ВРУ)',
                'sort'  => 10,
                'excerpt' => 'Шкафы ВРУ для приёма и распределения электроэнергии на объекте. Производство по техническому заданию заказчика.',
                'content' =>
                    '<p style="font-size:1.05em;color:#374151;line-height:1.75">Вводно-распределительное устройство (ВРУ) — это шкаф для приёма электроэнергии от внешней сети и её распределения по потребителям здания. ООО «ВТП Инжиниринг» производит ВРУ под любые условия: однолинейная схема, параметры ввода, количество отходящих линий.</p>'
                    . '<p style="color:#374151;line-height:1.75;margin-bottom:32px">Собственное производство в Москве. Сборка, испытания, доставка под ключ. Соответствие ГОСТ Р 51321.1.</p>'
                    . '<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:12px;margin-bottom:32px">'
                    . '<div style="background:#f8fafc;border-left:4px solid #2563eb;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Жилые здания и МКД</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Ввод электроснабжения в многоквартирный дом</div></div>'
                    . '<div style="background:#f8fafc;border-left:4px solid #2563eb;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Промышленные объекты</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Производственные цеха, склады, предприятия</div></div>'
                    . '<div style="background:#f8fafc;border-left:4px solid #2563eb;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Производство по ТЗ</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Любая схема, количество групп, степень защиты</div></div>'
                    . '<div style="background:#f8fafc;border-left:4px solid #2563eb;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Комплектация</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">ABB, Schneider Electric, IEK, КЭАЗ</div></div>'
                    . '</div>',
            ],
            [
                'slug'  => 'shkafy-avtomatiki-ventilyatsii',
                'title' => 'Шкафы автоматики вентиляции (ШАВ)',
                'sort'  => 11,
                'excerpt' => 'Шкафы управления системами вентиляции и кондиционирования. Погодозависимое регулирование, защиты, диспетчеризация.',
                'content' =>
                    '<p style="font-size:1.05em;color:#374151;line-height:1.75">Шкаф автоматики вентиляции (ШАВ) управляет приточно-вытяжными установками, клапанами, нагревателями и охладителями. Обеспечивает поддержание заданных параметров воздуха, погодозависимое регулирование и защиту от замерзания.</p>'
                    . '<p style="color:#374151;line-height:1.75;margin-bottom:32px">ООО «ВТП Инжиниринг» собирает ШАВ под проектную документацию: ПУЭ, ГОСТ Р 51321.1, требования СП 60.13330. Интеграция с диспетчерскими системами BACnet, Modbus, LonWorks.</p>'
                    . '<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:12px;margin-bottom:32px">'
                    . '<div style="background:#f8fafc;border-left:4px solid #0891b2;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Приточные установки</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Управление ПТО, клапанами, вентиляторами</div></div>'
                    . '<div style="background:#f8fafc;border-left:4px solid #0891b2;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Вытяжные системы</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Противодымная и общеобменная вентиляция</div></div>'
                    . '<div style="background:#f8fafc;border-left:4px solid #0891b2;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Диспетчеризация</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">BACnet, Modbus RTU/TCP, LonWorks</div></div>'
                    . '<div style="background:#f8fafc;border-left:4px solid #0891b2;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Защита от замерзания</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Аварийное закрытие клапанов при Т < +5°C</div></div>'
                    . '</div>',
            ],
            [
                'slug'  => 'shkafy-upravleniya-nasosami',
                'title' => 'Шкафы управления насосами (ШУН)',
                'sort'  => 12,
                'excerpt' => 'Шкафы для управления насосными агрегатами: поддержание давления, защита от сухого хода, чередование насосов.',
                'content' =>
                    '<p style="font-size:1.05em;color:#374151;line-height:1.75">Шкаф управления насосами (ШУН) обеспечивает автоматический пуск, остановку и защиту насосных агрегатов. Поддерживает заданное давление, управляет чередованием рабочего и резервного насосов, защищает от сухого хода.</p>'
                    . '<p style="color:#374151;line-height:1.75;margin-bottom:32px">ООО «ВТП Инжиниринг» производит ШУН для систем водоснабжения, пожаротушения, теплоснабжения. Сборка по проектной документации, заводские испытания, гарантия 5 лет.</p>'
                    . '<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:12px;margin-bottom:32px">'
                    . '<div style="background:#f8fafc;border-left:4px solid #2563eb;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Водоснабжение</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">ХВС, ГВС, повышение давления</div></div>'
                    . '<div style="background:#f8fafc;border-left:4px solid #2563eb;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Пожаротушение</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Спринклерные и дренчерные системы</div></div>'
                    . '<div style="background:#f8fafc;border-left:4px solid #2563eb;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Теплоснабжение</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Циркуляционные и подпиточные насосы ИТП/ЦТП</div></div>'
                    . '<div style="background:#f8fafc;border-left:4px solid #2563eb;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Защита от сухого хода</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Датчики давления, реле потока</div></div>'
                    . '</div>',
            ],
            [
                'slug'  => 'schity-upravleniya-chastotnymi-elektroprivodami',
                'title' => 'Щиты управления частотным электроприводом (ЩУ-ЧЭ)',
                'sort'  => 13,
                'excerpt' => 'Щиты с частотными преобразователями для плавного управления насосами и вентиляторами. Экономия электроэнергии до 40%.',
                'content' =>
                    '<p style="font-size:1.05em;color:#374151;line-height:1.75">Щит управления частотным электроприводом (ЩУ-ЧЭ) обеспечивает плавный пуск и регулировку скорости электродвигателей с помощью частотных преобразователей. Снижает пусковые токи, устраняет гидравлические удары, экономит электроэнергию до 40%.</p>'
                    . '<p style="color:#374151;line-height:1.75;margin-bottom:32px">ООО «ВТП Инжиниринг» применяет ЧП Danfoss, ABB, Schneider Electric, Веспер. Производство по ТЗ, программирование и пусконаладка на объекте.</p>'
                    . '<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:12px;margin-bottom:32px">'
                    . '<div style="background:#f8fafc;border-left:4px solid #7c3aed;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Насосы</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Поддержание давления без гидроударов</div></div>'
                    . '<div style="background:#f8fafc;border-left:4px solid #7c3aed;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Вентиляторы</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Регулировка производительности по датчику CO₂/Т</div></div>'
                    . '<div style="background:#f8fafc;border-left:4px solid #7c3aed;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Экономия</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">До 40% потребления электроэнергии</div></div>'
                    . '<div style="background:#f8fafc;border-left:4px solid #7c3aed;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">ЧП</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Danfoss, ABB, Schneider, Веспер</div></div>'
                    . '</div>',
            ],
            [
                'slug'  => 'shkafy-upravleniya-drenazhnymi-nasosami',
                'title' => 'Шкафы управления дренажными насосами (АСУ-ДН)',
                'sort'  => 14,
                'excerpt' => 'Шкафы для автоматического управления дренажными насосами по датчику уровня. Защита от переполнения и сухого хода.',
                'content' =>
                    '<p style="font-size:1.05em;color:#374151;line-height:1.75">АСУ-ДН — шкаф автоматического управления дренажными насосами по сигналам датчиков уровня. Включает насос при достижении верхнего уровня воды, отключает при достижении нижнего. Защищает от переполнения и сухого хода.</p>'
                    . '<p style="color:#374151;line-height:1.75;margin-bottom:32px">Применяется в приямках, подземных паркингах, технических подвалах, тоннелях. ООО «ВТП Инжиниринг» производит АСУ-ДН с резервированием насосов и диспетчеризацией.</p>'
                    . '<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:12px;margin-bottom:32px">'
                    . '<div style="background:#f8fafc;border-left:4px solid #0891b2;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Паркинги</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Откачка ливневых и грунтовых вод</div></div>'
                    . '<div style="background:#f8fafc;border-left:4px solid #0891b2;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Технические подвалы</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Приямки, дренажные колодцы</div></div>'
                    . '<div style="background:#f8fafc;border-left:4px solid #0891b2;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Датчики уровня</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Поплавковые и ультразвуковые</div></div>'
                    . '<div style="background:#f8fafc;border-left:4px solid #0891b2;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Резервирование</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Рабочий + резервный насос, автопереключение</div></div>'
                    . '</div>',
            ],
            [
                'slug'  => 'stantsiya-upravleniya-nasosami-su-pp',
                'title' => 'Станции управления насосами (СУ-ПП)',
                'sort'  => 15,
                'excerpt' => 'Станции управления насосами прямого пуска для систем водоснабжения, полива и технологических трубопроводов.',
                'content' =>
                    '<p style="font-size:1.05em;color:#374151;line-height:1.75">Станция управления насосами СУ-ПП обеспечивает прямой пуск насосных агрегатов с автоматическим поддержанием давления по реле давления или датчику давления. Оснащается индикацией, защитами и сухими контактами для диспетчеризации.</p>'
                    . '<p style="color:#374151;line-height:1.75;margin-bottom:32px">ООО «ВТП Инжиниринг» производит СУ-ПП для насосов мощностью от 0,37 до 45 кВт. Степень защиты IP54/IP65. Монтаж на раме станции или в отдельном шкафу.</p>'
                    . '<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:12px;margin-bottom:32px">'
                    . '<div style="background:#f8fafc;border-left:4px solid #16a34a;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Мощность</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">От 0,37 до 45 кВт на насос</div></div>'
                    . '<div style="background:#f8fafc;border-left:4px solid #16a34a;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Пуск</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Прямой или звезда-треугольник</div></div>'
                    . '<div style="background:#f8fafc;border-left:4px solid #16a34a;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Защиты</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Тепловое реле, автомат, сухой ход</div></div>'
                    . '<div style="background:#f8fafc;border-left:4px solid #16a34a;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">IP54/IP65</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Установка в помещениях с повышенной влажностью</div></div>'
                    . '</div>',
            ],
            [
                'slug'  => 'avtomaticheskie-stantsii-upravleniya-nasosami',
                'title' => 'Автоматические станции управления насосами (АСУ)',
                'sort'  => 16,
                'excerpt' => 'Полностью автоматические станции с ПЛК, сенсорным экраном, диспетчеризацией и частотным управлением.',
                'content' =>
                    '<p style="font-size:1.05em;color:#374151;line-height:1.75">Автоматическая станция управления насосами (АСУ) — это интеллектуальная система на базе ПЛК, обеспечивающая полностью автоматическую работу насосных агрегатов: поддержание давления, чередование, защиты, журналирование и диспетчеризация.</p>'
                    . '<p style="color:#374151;line-height:1.75;margin-bottom:32px">ООО «ВТП Инжиниринг» реализует АСУ с частотными преобразователями, сенсорными панелями оператора, архивированием данных и дистанционным мониторингом через SCADA или мобильное приложение.</p>'
                    . '<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:12px;margin-bottom:32px">'
                    . '<div style="background:#f8fafc;border-left:4px solid #2563eb;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">ПЛК управление</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Siemens, Weintek, Ovation</div></div>'
                    . '<div style="background:#f8fafc;border-left:4px solid #2563eb;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Сенсорная панель</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Визуализация параметров, журнал событий</div></div>'
                    . '<div style="background:#f8fafc;border-left:4px solid #2563eb;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Диспетчеризация</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Modbus TCP, MQTT, удалённый доступ</div></div>'
                    . '<div style="background:#f8fafc;border-left:4px solid #2563eb;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Частотный привод</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">ЧП на каждом насосе, экономия до 40%</div></div>'
                    . '</div>',
            ],
            [
                'slug'  => 'shkaf-upravleniya-elektrozadvizhkoy',
                'title' => 'Шкафы управления электрозадвижкой (ШУЗ)',
                'sort'  => 17,
                'excerpt' => 'Шкафы управления электроприводами задвижек и затворов трубопроводной арматуры. Дистанционное открытие/закрытие.',
                'content' =>
                    '<p style="font-size:1.05em;color:#374151;line-height:1.75">Шкаф управления электрозадвижкой (ШУЗ) обеспечивает дистанционное и местное управление электроприводами трубопроводной арматуры — задвижками, затворами, клапанами. Контролирует крайние положения «открыто/закрыто» и передаёт сигналы в систему диспетчеризации.</p>'
                    . '<p style="color:#374151;line-height:1.75;margin-bottom:32px">ООО «ВТП Инжиниринг» производит ШУЗ для одной и нескольких задвижек. Управление 220 В / 380 В. Интеграция с АСУ ТП и диспетчерскими системами.</p>'
                    . '<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:12px;margin-bottom:32px">'
                    . '<div style="background:#f8fafc;border-left:4px solid #ca8a04;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Задвижки</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Трубопроводы водоснабжения и теплоснабжения</div></div>'
                    . '<div style="background:#f8fafc;border-left:4px solid #ca8a04;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Затворы</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">ДУ50–ДУ1000, электропривод 220/380В</div></div>'
                    . '<div style="background:#f8fafc;border-left:4px solid #ca8a04;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Положение</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Концевые выключатели открыто/закрыто</div></div>'
                    . '<div style="background:#f8fafc;border-left:4px solid #ca8a04;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Диспетчеризация</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Сухие контакты, Modbus RTU</div></div>'
                    . '</div>',
            ],
            [
                'slug'  => 'shkafy-avr',
                'title' => 'Шкафы АВР (автоматический ввод резерва)',
                'sort'  => 18,
                'excerpt' => 'Шкафы АВР для автоматического переключения на резервный источник питания при пропадании основного.',
                'content' =>
                    '<p style="font-size:1.05em;color:#374151;line-height:1.75">Шкаф АВР (автоматический ввод резерва) автоматически переключает питание с основного ввода на резервный при пропадании или недопустимом отклонении напряжения. Обеспечивает бесперебойную работу критичных потребителей: насосов, лифтов, систем пожаротушения.</p>'
                    . '<p style="color:#374151;line-height:1.75;margin-bottom:32px">ООО «ВТП Инжиниринг» производит шкафы АВР с ячейками ВВ/ТСД, iSW, контакторами и логикой переключения на ПЛК или реле. Время переключения 0,1–5 с.</p>'
                    . '<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:12px;margin-bottom:32px">'
                    . '<div style="background:#f8fafc;border-left:4px solid #cc0000;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Насосные станции</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">ПНС, ПСП, насосы пожаротушения</div></div>'
                    . '<div style="background:#f8fafc;border-left:4px solid #cc0000;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Тепловые пункты</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">ИТП, ЦТП — резервирование питания</div></div>'
                    . '<div style="background:#f8fafc;border-left:4px solid #cc0000;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Время переключения</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">От 0,1 с (быстрый АВР)</div></div>'
                    . '<div style="background:#f8fafc;border-left:4px solid #cc0000;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">До 630 А</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Автоматы, контакторы, рубильники</div></div>'
                    . '</div>',
            ],
            [
                'slug'  => 'raspredelitelnye-shkafy',
                'title' => 'Распределительные шкафы (ШР)',
                'sort'  => 19,
                'excerpt' => 'Щиты и шкафы распределения электроэнергии по потребителям. Производство любой конфигурации по ТЗ.',
                'content' =>
                    '<p style="font-size:1.05em;color:#374151;line-height:1.75">Распределительный шкаф (ШР) обеспечивает распределение электроэнергии по группам потребителей с защитой каждой группы автоматическими выключателями или предохранителями. Применяется в качестве этажных и квартирных щитов, силовых шкафов и групповых распределительных устройств.</p>'
                    . '<p style="color:#374151;line-height:1.75;margin-bottom:32px">ООО «ВТП Инжиниринг» производит ШР в одиночных и многосекционных исполнениях. Корпуса Rittal, ABB, IEK. Любая однолинейная схема.</p>'
                    . '<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:12px;margin-bottom:32px">'
                    . '<div style="background:#f8fafc;border-left:4px solid #2563eb;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Жилые здания</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Этажные и квартирные щиты</div></div>'
                    . '<div style="background:#f8fafc;border-left:4px solid #2563eb;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Коммерция</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Офисные и торговые здания</div></div>'
                    . '<div style="background:#f8fafc;border-left:4px solid #2563eb;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Производство</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Силовые щиты и станции управления</div></div>'
                    . '<div style="background:#f8fafc;border-left:4px solid #2563eb;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">ABB / Schneider / IEK</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Ведущие производители автоматов</div></div>'
                    . '</div>',
            ],
            [
                'slug'  => 'shkaf-upravleniya-pozharotusheniem',
                'title' => 'Шкафы управления пожаротушением (АСУ-ПТ)',
                'sort'  => 20,
                'excerpt' => 'Шкафы управления насосами пожаротушения по СП 485 и НПБ 88. Автозапуск от АУПС, резервирование питания.',
                'content' =>
                    '<p style="font-size:1.05em;color:#374151;line-height:1.75">АСУ-ПТ — шкаф управления насосами установок пожаротушения. Обеспечивает автоматический пуск рабочего насоса по сигналу от АУПС или при падении давления, управление резервным насосом и жокей-насосом. Соответствует требованиям СП 485.1311500.2020 и НПБ 88.</p>'
                    . '<p style="color:#374151;line-height:1.75;margin-bottom:32px">ООО «ВТП Инжиниринг» производит АСУ-ПТ с питанием от двух независимых вводов, световой сигнализацией, журналом событий и интерфейсом для системы пожарной сигнализации.</p>'
                    . '<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:12px;margin-bottom:32px">'
                    . '<div style="background:#fff5f5;border-left:4px solid #cc0000;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">СП 485 / НПБ 88</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Полное соответствие нормативным требованиям</div></div>'
                    . '<div style="background:#fff5f5;border-left:4px solid #cc0000;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Автозапуск от АУПС</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Сигнал «Пуск» от системы пожарной сигнализации</div></div>'
                    . '<div style="background:#fff5f5;border-left:4px solid #cc0000;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Два ввода питания</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Основной + резервный с АВР</div></div>'
                    . '<div style="background:#fff5f5;border-left:4px solid #cc0000;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Ручной запуск</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Кнопки местного и дистанционного пуска</div></div>'
                    . '</div>',
            ],
            [
                'slug'  => 'avtomatizatsiya-kotelnykh',
                'title' => 'Автоматизация котельных установок',
                'sort'  => 21,
                'excerpt' => 'Шкафы и системы автоматизации котельных: управление горелками, насосами, клапанами, диспетчеризация.',
                'content' =>
                    '<p style="font-size:1.05em;color:#374151;line-height:1.75">Системы автоматизации котельных обеспечивают управление котлами, горелками, насосами подпитки и циркуляции, регулирующими клапанами. Поддерживают заданные температурные графики, защищают оборудование от аварийных режимов.</p>'
                    . '<p style="color:#374151;line-height:1.75;margin-bottom:32px">ООО «ВТП Инжиниринг» разрабатывает и производит шкафы АСУ котельных на базе ПЛК с сенсорной панелью, диспетчеризацией и погодозависимым регулированием. Интеграция с Modbus, BACnet, GSM-оповещением.</p>'
                    . '<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:12px;margin-bottom:32px">'
                    . '<div style="background:#f8fafc;border-left:4px solid #ea580c;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Управление котлами</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Горелки, температурные графики</div></div>'
                    . '<div style="background:#f8fafc;border-left:4px solid #ea580c;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Насосы</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Подпитка, циркуляция, рециркуляция</div></div>'
                    . '<div style="background:#f8fafc;border-left:4px solid #ea580c;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Диспетчеризация</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">GSM-оповещение, Modbus, удалённый доступ</div></div>'
                    . '<div style="background:#f8fafc;border-left:4px solid #ea580c;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Погодозависимое</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Регулирование по уличному датчику температуры</div></div>'
                    . '</div>',
            ],
            [
                'slug'  => 'stantsii-upravleniya-su-che',
                'title' => 'Станции управления СУ (СУ-ЧЭ)',
                'sort'  => 22,
                'excerpt' => 'Станции управления насосами с частотными преобразователями. Поддержание давления, чередование насосов, диспетчеризация.',
                'content' =>
                    '<p style="font-size:1.05em;color:#374151;line-height:1.75">Станция управления СУ-ЧЭ — это решение для управления несколькими насосами с частотными преобразователями на общей раме. Один частотный преобразователь поочерёдно обслуживает несколько насосов, снижая стоимость по сравнению с индивидуальными ЧП на каждый насос.</p>'
                    . '<p style="color:#374151;line-height:1.75;margin-bottom:32px">ООО «ВТП Инжиниринг» производит СУ-ЧЭ для систем повышения давления, пожаротушения, ГВС. Функция «главного преобразователя», Modbus RTU, степень защиты IP54.</p>'
                    . '<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:12px;margin-bottom:32px">'
                    . '<div style="background:#f8fafc;border-left:4px solid #7c3aed;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Один ЧП — несколько насосов</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Экономичное решение для 2–4 насосов</div></div>'
                    . '<div style="background:#f8fafc;border-left:4px solid #7c3aed;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Чередование</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Равномерная наработка насосов</div></div>'
                    . '<div style="background:#f8fafc;border-left:4px solid #7c3aed;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Modbus RTU</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Интеграция с диспетчерскими системами</div></div>'
                    . '<div style="background:#f8fafc;border-left:4px solid #7c3aed;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">IP54</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Монтаж в насосных станциях и подвалах</div></div>'
                    . '</div>',
            ],
            [
                'slug'  => 'schity-avtomaticheskogo-pereklyucheniya-na-rezerv',
                'title' => 'Щиты автоматического переключения на резерв (ЩАП)',
                'sort'  => 23,
                'excerpt' => 'Щиты ЩАП для ручного и автоматического переключения между двумя источниками питания.',
                'content' =>
                    '<p style="font-size:1.05em;color:#374151;line-height:1.75">Щит ЩАП (щит автоматического переключения) обеспечивает автоматическое переключение нагрузки между двумя секциями шин или источниками электроснабжения. В отличие от полноценного АВР, ЩАП проще по конструкции и применяется там, где допустимо кратковременное прерывание питания.</p>'
                    . '<p style="color:#374151;line-height:1.75;margin-bottom:32px">ООО «ВТП Инжиниринг» производит ЩАП с рубильниками IEK, ABB, Legrand. Переключение по пропаданию напряжения, фазы или по расписанию. IP31–IP54.</p>'
                    . '<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:12px;margin-bottom:32px">'
                    . '<div style="background:#f8fafc;border-left:4px solid #2563eb;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Ввод-ввод</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Два независимых ввода электроснабжения</div></div>'
                    . '<div style="background:#f8fafc;border-left:4px solid #2563eb;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Ввод-ДГУ</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Переход на дизельный генератор</div></div>'
                    . '<div style="background:#f8fafc;border-left:4px solid #2563eb;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">До 630 А</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Рубильники IEK, ABB, Legrand</div></div>'
                    . '<div style="background:#f8fafc;border-left:4px solid #2563eb;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">IP31–IP54</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Настенный или напольный шкаф</div></div>'
                    . '</div>',
            ],
        ];

        foreach ($items as $item) {
            $existing = DB::table('pages')->where('slug', $item['slug'])->first();
            if ($existing) {
                DB::table('pages')->where('slug', $item['slug'])->update([
                    'title'      => $item['title'],
                    'content'    => $item['content'],
                    'excerpt'    => $item['excerpt'],
                    'sort'       => $item['sort'],
                    'parent_id'  => $parentId,
                    'type'       => 'service',
                    'is_active'  => true,
                    'updated_at' => now(),
                ]);
            } else {
                DB::table('pages')->insert([
                    'slug'       => $item['slug'],
                    'title'      => $item['title'],
                    'content'    => $item['content'],
                    'excerpt'    => $item['excerpt'],
                    'sort'       => $item['sort'],
                    'parent_id'  => $parentId,
                    'type'       => 'service',
                    'is_active'  => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    public function down(): void {}
};
