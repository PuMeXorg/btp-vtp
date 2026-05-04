<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $equipmentSection = '
<h2 style="font-size:1.4em;font-weight:700;color:#111827;margin:40px 0 20px">Что входит в состав БТП</h2>
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:16px;margin-bottom:36px">

  <div style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:12px;padding:20px">
    <div style="width:40px;height:40px;background:#cc0000;border-radius:8px;display:flex;align-items:center;justify-content:center;margin-bottom:12px">
      <svg width="22" height="22" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
    </div>
    <div style="font-weight:700;color:#111827;margin-bottom:10px;font-size:.95em">Узел ввода и учёта тепловой энергии</div>
    <ul style="list-style:none;padding:0;margin:0;color:#6b7280;font-size:.88em;line-height:2">
      <li>• Теплосчётчик с расходомером</li>
      <li>• Фильтры грязевые / сетчатые</li>
      <li>• Запорная арматура (шаровые краны)</li>
      <li>• Манометры и термометры</li>
    </ul>
  </div>

  <div style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:12px;padding:20px">
    <div style="width:40px;height:40px;background:#cc0000;border-radius:8px;display:flex;align-items:center;justify-content:center;margin-bottom:12px">
      <svg width="22" height="22" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>
    </div>
    <div style="font-weight:700;color:#111827;margin-bottom:10px;font-size:.95em">Теплообменный блок</div>
    <ul style="list-style:none;padding:0;margin:0;color:#6b7280;font-size:.88em;line-height:2">
      <li>• Пластинчатый разборный теплообменник</li>
      <li>• Обвязочные трубопроводы</li>
      <li>• Обратные клапаны</li>
      <li>• Предохранительные клапаны</li>
    </ul>
  </div>

  <div style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:12px;padding:20px">
    <div style="width:40px;height:40px;background:#cc0000;border-radius:8px;display:flex;align-items:center;justify-content:center;margin-bottom:12px">
      <svg width="22" height="22" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M12 1v4M12 19v4M4.22 4.22l2.83 2.83M16.95 16.95l2.83 2.83M1 12h4M19 12h4M4.22 19.78l2.83-2.83M16.95 7.05l2.83-2.83"/></svg>
    </div>
    <div style="font-weight:700;color:#111827;margin-bottom:10px;font-size:.95em">Насосная группа</div>
    <ul style="list-style:none;padding:0;margin:0;color:#6b7280;font-size:.88em;line-height:2">
      <li>• Циркуляционные насосы отопления</li>
      <li>• Циркуляционные насосы ГВС</li>
      <li>• Резервный насос (опционально)</li>
      <li>• Виброкомпенсаторы</li>
    </ul>
  </div>

  <div style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:12px;padding:20px">
    <div style="width:40px;height:40px;background:#cc0000;border-radius:8px;display:flex;align-items:center;justify-content:center;margin-bottom:12px">
      <svg width="22" height="22" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/></svg>
    </div>
    <div style="font-weight:700;color:#111827;margin-bottom:10px;font-size:.95em">Система автоматизации и управления</div>
    <ul style="list-style:none;padding:0;margin:0;color:#6b7280;font-size:.88em;line-height:2">
      <li>• Щит автоматики с контроллером</li>
      <li>• Датчики температуры и давления</li>
      <li>• Регулирующие клапаны с электроприводом</li>
      <li>• Диспетчеризация (опционально)</li>
    </ul>
  </div>

  <div style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:12px;padding:20px">
    <div style="width:40px;height:40px;background:#cc0000;border-radius:8px;display:flex;align-items:center;justify-content:center;margin-bottom:12px">
      <svg width="22" height="22" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14,2 14,8 20,8"/></svg>
    </div>
    <div style="font-weight:700;color:#111827;margin-bottom:10px;font-size:.95em">Рамная конструкция и обвязка</div>
    <ul style="list-style:none;padding:0;margin:0;color:#6b7280;font-size:.88em;line-height:2">
      <li>• Стальная сварная рама (поддон)</li>
      <li>• Теплоизоляция трубопроводов</li>
      <li>• Система дренажа</li>
      <li>• Монтажные патрубки для подключения</li>
    </ul>
  </div>

  <div style="background:#fff5f5;border:1px solid #fecaca;border-radius:12px;padding:20px">
    <div style="width:40px;height:40px;background:#cc0000;border-radius:8px;display:flex;align-items:center;justify-content:center;margin-bottom:12px">
      <svg width="22" height="22" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
    </div>
    <div style="font-weight:700;color:#111827;margin-bottom:10px;font-size:.95em">Комплектация — под ваш объект</div>
    <ul style="list-style:none;padding:0;margin:0;color:#6b7280;font-size:.88em;line-height:2">
      <li>• Отопление (независимая схема)</li>
      <li>• Горячее водоснабжение (ГВС)</li>
      <li>• Вентиляция и кондиционирование</li>
      <li>• Подпитка системы</li>
    </ul>
  </div>

</div>

<div style="background:#1f2937;color:#fff;border-radius:12px;padding:24px;margin-bottom:36px">
  <div style="font-weight:700;font-size:1.05em;margin-bottom:16px;color:#f9fafb">Принципиальная схема работы БТП</div>
  <div style="display:flex;flex-wrap:wrap;gap:0;align-items:center;justify-content:center">
    <div style="text-align:center;padding:12px 16px">
      <div style="background:#cc0000;border-radius:8px;padding:10px 14px;font-size:.8em;font-weight:600;white-space:nowrap">Тепловая сеть<br><span style="font-weight:400;opacity:.8">(первичный контур)</span></div>
    </div>
    <div style="color:#cc0000;font-size:1.4em;padding:0 4px">→</div>
    <div style="text-align:center;padding:12px 8px">
      <div style="background:#374151;border-radius:8px;padding:10px 14px;font-size:.8em;font-weight:600;white-space:nowrap">Узел учёта<br><span style="font-weight:400;opacity:.8">счётчик + фильтр</span></div>
    </div>
    <div style="color:#cc0000;font-size:1.4em;padding:0 4px">→</div>
    <div style="text-align:center;padding:12px 8px">
      <div style="background:#374151;border-radius:8px;padding:10px 14px;font-size:.8em;font-weight:600;white-space:nowrap">Теплообменник<br><span style="font-weight:400;opacity:.8">разделение контуров</span></div>
    </div>
    <div style="color:#cc0000;font-size:1.4em;padding:0 4px">→</div>
    <div style="text-align:center;padding:12px 8px">
      <div style="background:#374151;border-radius:8px;padding:10px 14px;font-size:.8em;font-weight:600;white-space:nowrap">Насосная группа<br><span style="font-weight:400;opacity:.8">циркуляция</span></div>
    </div>
    <div style="color:#cc0000;font-size:1.4em;padding:0 4px">→</div>
    <div style="text-align:center;padding:12px 16px">
      <div style="background:#cc0000;border-radius:8px;padding:10px 14px;font-size:.8em;font-weight:600;white-space:nowrap">Объект<br><span style="font-weight:400;opacity:.8">отопление / ГВС</span></div>
    </div>
  </div>
  <div style="text-align:center;margin-top:12px;font-size:.8em;opacity:.6">Система автоматизации контролирует все параметры в режиме реального времени</div>
</div>
';

        $page = DB::table('pages')->where('slug', 'blochnyy-teplovoy-punkt')->first();
        if (!$page) return;

        // Insert equipment section before "Этапы работы"
        $newContent = str_replace(
            '<h2 style="font-size:1.4em;font-weight:700;color:#111827;margin:32px 0 16px">Этапы работы</h2>',
            $equipmentSection . '<h2 style="font-size:1.4em;font-weight:700;color:#111827;margin:32px 0 16px">Этапы работы</h2>',
            $page->content
        );

        DB::table('pages')->where('slug', 'blochnyy-teplovoy-punkt')->update([
            'content' => $newContent,
        ]);
    }

    public function down(): void {}
};
