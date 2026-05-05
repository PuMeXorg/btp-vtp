<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Create parent section "Насосные станции" (safe upsert)
        $existing = DB::table('pages')->where('slug', 'nasosnye-stantsii')->first();
        if ($existing) {
            $parentId = $existing->id;
            DB::table('pages')->where('id', $parentId)->update([
                'title' => 'Насосные станции', 'type' => 'service',
                'parent_id' => null, 'is_active' => 1, 'sort' => 20, 'updated_at' => now(),
            ]);
        } else {
            $parentId = DB::table('pages')->insertGetId([
                'title'            => 'Насосные станции',
                'slug'             => 'nasosnye-stantsii',
                'type'             => 'service',
                'parent_id'        => null,
                'content'          => '',
                'excerpt'          => 'Повысительные, противопожарные и насосные станции поддержания давления — проектирование и поставка под ключ.',
                'meta_title'       => 'Насосные станции — ВТП Инжиниринг',
                'meta_description' => 'Проектирование и поставка насосных станций в Москве. Повысительные, пожаротушения, поддержания давления.',
                'is_active'        => 1,
                'sort'             => 20,
                'image'            => null,
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);
        }

        // 2. Move "Насосные станции пожаротушения" under the new parent
        DB::table('pages')
            ->where('slug', 'nasosnye-stantsii-pozharotusheniya')
            ->update(['parent_id' => $parentId, 'sort' => 2, 'updated_at' => now()]);

        // 3. Create "Насосные станции поддержания давления"
        $contentPDD = '<img src="/public/images/fire/stancia3.jpg" alt="Насосная станция поддержания давления" style="width:100%;border-radius:12px;margin-bottom:24px;max-height:460px;object-fit:cover;object-position:center top">'
            . '<p style="font-size:1.05em;color:#374151;line-height:1.75">Насосные станции поддержания давления обеспечивают стабильное давление в системах холодного и горячего водоснабжения, тепловых сетях и системах отопления. Применяются там, где давление в магистрали недостаточно для нормальной работы потребителей.</p>'
            . '<p style="color:#374151;line-height:1.75;margin-bottom:32px">ООО «ВТП Инжиниринг» проектирует и поставляет станции поддержания давления под параметры конкретного объекта. Полная заводская сборка, испытания на стенде и гарантия 60 месяцев.</p>'
            . '<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:12px;margin-bottom:40px">'
            . '<div style="background:#fff5f5;border-left:4px solid #cc0000;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">ХВС и ГВС</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Поддержание давления в системах водоснабжения</div></div>'
            . '<div style="background:#fff5f5;border-left:4px solid #cc0000;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Системы отопления</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Поддержание давления в тепловых контурах</div></div>'
            . '<div style="background:#fff5f5;border-left:4px solid #cc0000;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Тепловые сети</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Подпитка и компенсация потерь давления</div></div>'
            . '<div style="background:#fff5f5;border-left:4px solid #cc0000;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Промышленные объекты</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Производственные и складские комплексы</div></div>'
            . '</div>'
            . '<h2 style="font-size:1.4em;font-weight:700;color:#111827;margin:32px 0 16px">Этапы работы</h2>'
            . '<div style="display:flex;flex-direction:column;gap:0">'
            . '<div style="display:flex;gap:16px;align-items:flex-start;padding:16px 0;border-bottom:1px solid #f3f4f6"><div style="background:#cc0000;color:#fff;border-radius:50%;width:36px;height:36px;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.9em;flex-shrink:0">01</div><div><div style="font-weight:600;color:#111827;margin-bottom:3px">Заявка и исходные данные</div><div style="color:#6b7280;font-size:.9em">Принимаем ТЗ: расход, давление на входе и выходе, тип системы</div></div></div>'
            . '<div style="display:flex;gap:16px;align-items:flex-start;padding:16px 0;border-bottom:1px solid #f3f4f6"><div style="background:#cc0000;color:#fff;border-radius:50%;width:36px;height:36px;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.9em;flex-shrink:0">02</div><div><div style="font-weight:600;color:#111827;margin-bottom:3px">Гидравлический расчёт и подбор</div><div style="color:#6b7280;font-size:.9em">Подбираем насосы, частотный привод, обвязку</div></div></div>'
            . '<div style="display:flex;gap:16px;align-items:flex-start;padding:16px 0;border-bottom:1px solid #f3f4f6"><div style="background:#cc0000;color:#fff;border-radius:50%;width:36px;height:36px;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.9em;flex-shrink:0">03</div><div><div style="font-weight:600;color:#111827;margin-bottom:3px">Коммерческое предложение</div><div style="color:#6b7280;font-size:.9em">КП с составом оборудования, ценой и сроками</div></div></div>'
            . '<div style="display:flex;gap:16px;align-items:flex-start;padding:16px 0;border-bottom:1px solid #f3f4f6"><div style="background:#cc0000;color:#fff;border-radius:50%;width:36px;height:36px;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.9em;flex-shrink:0">04</div><div><div style="font-weight:600;color:#111827;margin-bottom:3px">Сборка и испытания</div><div style="color:#6b7280;font-size:.9em">Заводская сборка, проверка на испытательном стенде</div></div></div>'
            . '<div style="display:flex;gap:16px;align-items:flex-start;padding:16px 0;border-bottom:1px solid #f3f4f6"><div style="background:#cc0000;color:#fff;border-radius:50%;width:36px;height:36px;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.9em;flex-shrink:0">05</div><div><div style="font-weight:600;color:#111827;margin-bottom:3px">Поставка и монтаж</div><div style="color:#6b7280;font-size:.9em">Доставка на объект, подключение к трубопроводам и электросети</div></div></div>'
            . '<div style="display:flex;gap:16px;align-items:flex-start;padding:16px 0"><div style="background:#cc0000;color:#fff;border-radius:50%;width:36px;height:36px;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.9em;flex-shrink:0">06</div><div><div style="font-weight:600;color:#111827;margin-bottom:3px">Пусконаладка и сдача</div><div style="color:#6b7280;font-size:.9em">Настраиваем давление, частотный привод, сдаём с документацией</div></div></div>'
            . '</div>'
            . '<div style="background:#fff5f5;border:1px solid #fecaca;border-radius:12px;padding:20px;margin-top:28px;display:flex;align-items:center;gap:16px">'
            . '<i class="fas fa-shield-halved" style="font-size:2.2em;color:#cc0000;flex-shrink:0"></i>'
            . '<div><div style="font-weight:700;color:#111827;margin-bottom:4px">Гарантия 60 месяцев</div><div style="color:#6b7280;font-size:.9em">На все выполненные работы и оборудование — 5 лет с момента подписания акта приёмки.</div></div>'
            . '</div>';

        DB::table('pages')->where('slug', 'nasosnye-stantsii-podderzhania-davlenia')->delete();
        DB::table('pages')->insert([
            'title'            => 'Насосные станции поддержания давления',
            'slug'             => 'nasosnye-stantsii-podderzhania-davlenia',
            'type'             => 'service',
            'parent_id'        => $parentId,
            'content'          => $contentPDD,
            'excerpt'          => 'Проектирование и поставка насосных станций поддержания давления. ХВС, ГВС, отопление. Гарантия 60 месяцев.',
            'meta_title'       => 'Насосные станции поддержания давления — ВТП Инжиниринг',
            'meta_description' => 'Поставка насосных станций поддержания давления в Москве. Под ключ, гарантия 5 лет.',
            'is_active'        => 1,
            'sort'             => 3,
            'image'            => null,
            'created_at'       => now(),
            'updated_at'       => now(),
        ]);

        // 4. Create "Повысительные насосные станции"
        $contentPov = '<img src="/public/images/fire/stancia4.jpg" alt="Повысительная насосная станция" style="width:100%;border-radius:12px;margin-bottom:24px;max-height:460px;object-fit:cover;object-position:center top">'
            . '<p style="font-size:1.05em;color:#374151;line-height:1.75">Повысительные насосные станции применяются для увеличения давления в системах холодного и горячего водоснабжения, когда давление в городской магистрали недостаточно для подачи воды на верхние этажи зданий или к удалённым потребителям.</p>'
            . '<p style="color:#374151;line-height:1.75;margin-bottom:32px">ООО «ВТП Инжиниринг» проектирует и поставляет повысительные станции с частотным регулированием — для плавного поддержания давления без гидравлических ударов. Заводская сборка, испытания, гарантия 60 месяцев.</p>'
            . '<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:12px;margin-bottom:40px">'
            . '<div style="background:#fff5f5;border-left:4px solid #cc0000;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Жилые здания</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Подъём давления для высотных жилых домов</div></div>'
            . '<div style="background:#fff5f5;border-left:4px solid #cc0000;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Бизнес-центры</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">ХВС и ГВС для офисных и торговых объектов</div></div>'
            . '<div style="background:#fff5f5;border-left:4px solid #cc0000;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Промышленность</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Водоснабжение производственных объектов</div></div>'
            . '<div style="background:#fff5f5;border-left:4px solid #cc0000;padding:14px 16px;border-radius:8px"><div style="font-weight:700;color:#111827;font-size:.9em">Паркинги и склады</div><div style="color:#6b7280;font-size:.82em;margin-top:4px">Системы водоснабжения и пожаротушения</div></div>'
            . '</div>'
            . '<h2 style="font-size:1.4em;font-weight:700;color:#111827;margin:32px 0 16px">Этапы работы</h2>'
            . '<div style="display:flex;flex-direction:column;gap:0">'
            . '<div style="display:flex;gap:16px;align-items:flex-start;padding:16px 0;border-bottom:1px solid #f3f4f6"><div style="background:#cc0000;color:#fff;border-radius:50%;width:36px;height:36px;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.9em;flex-shrink:0">01</div><div><div style="font-weight:600;color:#111827;margin-bottom:3px">Заявка и исходные данные</div><div style="color:#6b7280;font-size:.9em">Принимаем ТЗ: требуемое давление, расход, схема водоснабжения</div></div></div>'
            . '<div style="display:flex;gap:16px;align-items:flex-start;padding:16px 0;border-bottom:1px solid #f3f4f6"><div style="background:#cc0000;color:#fff;border-radius:50%;width:36px;height:36px;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.9em;flex-shrink:0">02</div><div><div style="font-weight:600;color:#111827;margin-bottom:3px">Расчёт и подбор оборудования</div><div style="color:#6b7280;font-size:.9em">Подбираем насосы с частотным приводом, мембранный бак, автоматику</div></div></div>'
            . '<div style="display:flex;gap:16px;align-items:flex-start;padding:16px 0;border-bottom:1px solid #f3f4f6"><div style="background:#cc0000;color:#fff;border-radius:50%;width:36px;height:36px;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.9em;flex-shrink:0">03</div><div><div style="font-weight:600;color:#111827;margin-bottom:3px">Коммерческое предложение</div><div style="color:#6b7280;font-size:.9em">КП с составом оборудования, ценой и сроками поставки</div></div></div>'
            . '<div style="display:flex;gap:16px;align-items:flex-start;padding:16px 0;border-bottom:1px solid #f3f4f6"><div style="background:#cc0000;color:#fff;border-radius:50%;width:36px;height:36px;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.9em;flex-shrink:0">04</div><div><div style="font-weight:600;color:#111827;margin-bottom:3px">Сборка и испытания</div><div style="color:#6b7280;font-size:.9em">Заводская сборка, проверка работы на испытательном стенде</div></div></div>'
            . '<div style="display:flex;gap:16px;align-items:flex-start;padding:16px 0;border-bottom:1px solid #f3f4f6"><div style="background:#cc0000;color:#fff;border-radius:50%;width:36px;height:36px;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.9em;flex-shrink:0">05</div><div><div style="font-weight:600;color:#111827;margin-bottom:3px">Поставка и монтаж</div><div style="color:#6b7280;font-size:.9em">Доставка на объект, установка и подключение</div></div></div>'
            . '<div style="display:flex;gap:16px;align-items:flex-start;padding:16px 0"><div style="background:#cc0000;color:#fff;border-radius:50%;width:36px;height:36px;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.9em;flex-shrink:0">06</div><div><div style="font-weight:600;color:#111827;margin-bottom:3px">Пусконаладка и сдача</div><div style="color:#6b7280;font-size:.9em">Настраиваем частотный привод, уставки давления, сдаём с документацией</div></div></div>'
            . '</div>'
            . '<div style="background:#fff5f5;border:1px solid #fecaca;border-radius:12px;padding:20px;margin-top:28px;display:flex;align-items:center;gap:16px">'
            . '<i class="fas fa-shield-halved" style="font-size:2.2em;color:#cc0000;flex-shrink:0"></i>'
            . '<div><div style="font-weight:700;color:#111827;margin-bottom:4px">Гарантия 60 месяцев</div><div style="color:#6b7280;font-size:.9em">На все выполненные работы и оборудование — 5 лет с момента подписания акта приёмки.</div></div>'
            . '</div>';

        DB::table('pages')->where('slug', 'povysitelnye-nasosnye-stantsii')->delete();
        DB::table('pages')->insert([
            'title'            => 'Повысительные насосные станции',
            'slug'             => 'povysitelnye-nasosnye-stantsii',
            'type'             => 'service',
            'parent_id'        => $parentId,
            'content'          => $contentPov,
            'excerpt'          => 'Проектирование и поставка повысительных насосных станций. Частотное регулирование, без гидроударов. Гарантия 60 месяцев.',
            'meta_title'       => 'Повысительные насосные станции — ВТП Инжиниринг',
            'meta_description' => 'Поставка повысительных насосных станций в Москве. Частотный привод, заводская сборка. Гарантия 5 лет.',
            'is_active'        => 1,
            'sort'             => 1,
            'image'            => null,
            'created_at'       => now(),
            'updated_at'       => now(),
        ]);
    }

    public function down(): void
    {
        DB::table('pages')->whereIn('slug', [
            'nasosnye-stantsii',
            'nasosnye-stantsii-podderzhania-davlenia',
            'povysitelnye-nasosnye-stantsii',
        ])->delete();

        DB::table('pages')
            ->where('slug', 'nasosnye-stantsii-pozharotusheniya')
            ->update(['parent_id' => null, 'sort' => 10]);
    }
};
