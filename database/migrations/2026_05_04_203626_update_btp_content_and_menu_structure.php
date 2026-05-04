<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('pages')
            ->where('title', 'like', '%Канализационные насосные станции%')
            ->update(['title' => 'Насосные станции поддержания давления']);

        DB::table('pages')
            ->where('type', 'service')
            ->where('title', 'like', '%Проектирование%')
            ->whereNotNull('parent_id')
            ->update(['parent_id' => null]);

        $content = '<img src="/public/images/about/btp-main.webp" alt="Блочный тепловой пункт" style="width:100%;border-radius:12px;margin-bottom:24px;max-height:420px;object-fit:cover;"><p style="font-size:1.05em;color:#374151;line-height:1.75">Блочные тепловые пункты (БТП) созданы для обеспечения надёжной и бесперебойной работы систем теплоснабжения и горячего водоснабжения (ГВС), рационального использования энергетических ресурсов, а также для упрощения дальнейшей модернизации инженерных систем.</p><p style="color:#374151;line-height:1.75">ООО «ВТП Инжиниринг» проектирует и поставляет блочные тепловые пункты под индивидуальные требования каждого объекта. Мы обеспечиваем полное техническое сопровождение — от подбора оборудования до пуско-наладки и сдачи объекта.</p><h2 style="font-size:1.4em;font-weight:700;color:#111827;margin:32px 0 16px">Этапы работы</h2><div style="display:flex;flex-direction:column;gap:0"><div style="display:flex;gap:16px;align-items:flex-start;padding:16px 0;border-bottom:1px solid #f3f4f6"><div style="background:#cc0000;color:#fff;border-radius:50%;width:36px;height:36px;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.9em;flex-shrink:0">01</div><div><div style="font-weight:600;color:#111827;margin-bottom:3px">Заявка и техническое задание</div><div style="color:#6b7280;font-size:.9em">Составляем ТЗ на основании параметров объекта</div></div></div><div style="display:flex;gap:16px;align-items:flex-start;padding:16px 0;border-bottom:1px solid #f3f4f6"><div style="background:#cc0000;color:#fff;border-radius:50%;width:36px;height:36px;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.9em;flex-shrink:0">02</div><div><div style="font-weight:600;color:#111827;margin-bottom:3px">Коммерческое предложение</div><div style="color:#6b7280;font-size:.9em">Подбираем оборудование, готовим обоснование</div></div></div><div style="display:flex;gap:16px;align-items:flex-start;padding:16px 0;border-bottom:1px solid #f3f4f6"><div style="background:#cc0000;color:#fff;border-radius:50%;width:36px;height:36px;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.9em;flex-shrink:0">03</div><div><div style="font-weight:600;color:#111827;margin-bottom:3px">Договор и поставка</div><div style="color:#6b7280;font-size:.9em">Оформляем договор, контролируем поставку</div></div></div><div style="display:flex;gap:16px;align-items:flex-start;padding:16px 0;border-bottom:1px solid #f3f4f6"><div style="background:#cc0000;color:#fff;border-radius:50%;width:36px;height:36px;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.9em;flex-shrink:0">04</div><div><div style="font-weight:600;color:#111827;margin-bottom:3px">Пуско-наладка</div><div style="color:#6b7280;font-size:.9em">Настраиваем параметры, проводим пробный запуск</div></div></div><div style="display:flex;gap:16px;align-items:flex-start;padding:16px 0;border-bottom:1px solid #f3f4f6"><div style="background:#cc0000;color:#fff;border-radius:50%;width:36px;height:36px;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.9em;flex-shrink:0">05</div><div><div style="font-weight:600;color:#111827;margin-bottom:3px">Сдача объекта</div><div style="color:#6b7280;font-size:.9em">Сдаём объект по нормативным требованиям</div></div></div><div style="display:flex;gap:16px;align-items:flex-start;padding:16px 0"><div style="background:#cc0000;color:#fff;border-radius:50%;width:36px;height:36px;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.9em;flex-shrink:0">06</div><div><div style="font-weight:600;color:#111827;margin-bottom:3px">Гарантийное обслуживание</div><div style="color:#6b7280;font-size:.9em">Поддержка на весь срок гарантии</div></div></div></div><div style="background:#fff5f5;border:1px solid #fecaca;border-radius:12px;padding:20px;margin-top:28px;display:flex;align-items:center;gap:16px"><div style="font-size:2em;flex-shrink:0">🛡</div><div><div style="font-weight:700;color:#111827;margin-bottom:4px">Гарантия 60 месяцев</div><div style="color:#6b7280;font-size:.9em">На все выполненные работы и оборудование — 5 лет с момента подписания акта приёмки.</div></div></div>';

        DB::table('pages')->where('slug', 'blochnyy-teplovoy-punkt')->update([
            'image'            => null,
            'content'          => $content,
            'excerpt'          => 'Проектирование и поставка БТП под ключ. До 4 МВт, автоматизация, гарантия 60 месяцев.',
            'meta_title'       => 'Блочный тепловой пункт (БТП) — ВТП Инжиниринг',
            'meta_description' => 'Проектирование и поставка блочных тепловых пунктов в Москве. Под ключ, гарантия 5 лет.',
        ]);
    }

    public function down(): void {}
};
