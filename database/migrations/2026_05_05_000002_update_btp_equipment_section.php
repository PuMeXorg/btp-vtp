<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $page = DB::table('pages')->where('slug', 'blochnyy-teplovoy-punkt')->first();
        if (!$page) return;

        // Remove the old equipment section (from previous migration) and replace with new
        $content = $page->content;

        // Strip everything from the equipment heading to the "Этапы работы" heading
        $content = preg_replace(
            '/<h2[^>]*>Что входит в состав БТП<\/h2>.*?(<h2[^>]*>Этапы работы<\/h2>)/s',
            '$1',
            $content
        );

        $equipmentSection = '
<h2 style="font-size:1.5em;font-weight:700;color:#111827;margin:40px 0 8px;text-align:center">Какое оборудование входит в состав БТП?</h2>
<p style="text-align:center;color:#6b7280;margin-bottom:32px;font-size:.95em">Нажмите на элемент, чтобы узнать подробнее</p>

<div style="position:relative;display:flex;gap:24px;align-items:center;flex-wrap:wrap;justify-content:center;margin-bottom:40px">

  <!-- Left column -->
  <div style="display:flex;flex-direction:column;gap:16px;flex:0 0 auto;width:180px">

    <button onclick="btpModal(\'flowmeter\')" style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:12px;padding:16px;cursor:pointer;text-align:center;transition:box-shadow .2s;width:100%" onmouseover="this.style.boxShadow=\'0 4px 16px rgba(0,0,0,.1)\'" onmouseout="this.style.boxShadow=\'none\'">
      <div style="width:56px;height:56px;background:#eff6ff;border-radius:50%;margin:0 auto 8px;display:flex;align-items:center;justify-content:center">
        <svg width="28" height="28" fill="none" stroke="#2563eb" stroke-width="1.8" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/><path d="M7 12H3M21 12h-4"/></svg>
      </div>
      <div style="font-size:.82em;font-weight:600;color:#111827;line-height:1.3">Расходомер-<br>счётчик</div>
    </button>

    <button onclick="btpModal(\'filter\')" style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:12px;padding:16px;cursor:pointer;text-align:center;transition:box-shadow .2s;width:100%" onmouseover="this.style.boxShadow=\'0 4px 16px rgba(0,0,0,.1)\'" onmouseout="this.style.boxShadow=\'none\'">
      <div style="width:56px;height:56px;background:#f0fdf4;border-radius:50%;margin:0 auto 8px;display:flex;align-items:center;justify-content:center">
        <svg width="28" height="28" fill="none" stroke="#16a34a" stroke-width="1.8" viewBox="0 0 24 24"><path d="M3 4h18v2l-7 7v7l-4-2v-5L3 6V4z"/></svg>
      </div>
      <div style="font-size:.82em;font-weight:600;color:#111827;line-height:1.3">Фильтр<br>сетчатый</div>
    </button>

    <button onclick="btpModal(\'pump\')" style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:12px;padding:16px;cursor:pointer;text-align:center;transition:box-shadow .2s;width:100%" onmouseover="this.style.boxShadow=\'0 4px 16px rgba(0,0,0,.1)\'" onmouseout="this.style.boxShadow=\'none\'">
      <div style="width:56px;height:56px;background:#fef9c3;border-radius:50%;margin:0 auto 8px;display:flex;align-items:center;justify-content:center">
        <svg width="28" height="28" fill="none" stroke="#ca8a04" stroke-width="1.8" viewBox="0 0 24 24"><circle cx="12" cy="12" r="4"/><path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/></svg>
      </div>
      <div style="font-size:.82em;font-weight:600;color:#111827;line-height:1.3">Насос<br>циркуляционный</div>
    </button>

  </div>

  <!-- Center image -->
  <div style="flex:1;min-width:220px;max-width:400px;text-align:center">
    <img src="/public/images/about/btp-main.webp" alt="Блочный тепловой пункт" style="width:100%;border-radius:12px;object-fit:cover;max-height:380px">
  </div>

  <!-- Right column -->
  <div style="display:flex;flex-direction:column;gap:16px;flex:0 0 auto;width:180px">

    <button onclick="btpModal(\'drive\')" style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:12px;padding:16px;cursor:pointer;text-align:center;transition:box-shadow .2s;width:100%" onmouseover="this.style.boxShadow=\'0 4px 16px rgba(0,0,0,.1)\'" onmouseout="this.style.boxShadow=\'none\'">
      <div style="width:56px;height:56px;background:#fdf4ff;border-radius:50%;margin:0 auto 8px;display:flex;align-items:center;justify-content:center">
        <svg width="28" height="28" fill="none" stroke="#9333ea" stroke-width="1.8" viewBox="0 0 24 24"><rect x="5" y="2" width="14" height="10" rx="2"/><path d="M9 12v4M15 12v4M7 20h10M12 16v4"/></svg>
      </div>
      <div style="font-size:.82em;font-weight:600;color:#111827;line-height:1.3">Электро-<br>привод</div>
    </button>

    <button onclick="btpModal(\'valve\')" style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:12px;padding:16px;cursor:pointer;text-align:center;transition:box-shadow .2s;width:100%" onmouseover="this.style.boxShadow=\'0 4px 16px rgba(0,0,0,.1)\'" onmouseout="this.style.boxShadow=\'none\'">
      <div style="width:56px;height:56px;background:#fff1f2;border-radius:50%;margin:0 auto 8px;display:flex;align-items:center;justify-content:center">
        <svg width="28" height="28" fill="none" stroke="#e11d48" stroke-width="1.8" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/><path d="M8 12h8M12 8v8"/></svg>
      </div>
      <div style="font-size:.82em;font-weight:600;color:#111827;line-height:1.3">Кран<br>шаровый</div>
    </button>

    <button onclick="btpModal(\'hx\')" style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:12px;padding:16px;cursor:pointer;text-align:center;transition:box-shadow .2s;width:100%" onmouseover="this.style.boxShadow=\'0 4px 16px rgba(0,0,0,.1)\'" onmouseout="this.style.boxShadow=\'none\'">
      <div style="width:56px;height:56px;background:#fff7ed;border-radius:50%;margin:0 auto 8px;display:flex;align-items:center;justify-content:center">
        <svg width="28" height="28" fill="none" stroke="#ea580c" stroke-width="1.8" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="9" y1="3" x2="9" y2="21"/><line x1="15" y1="3" x2="15" y2="21"/></svg>
      </div>
      <div style="font-size:.82em;font-weight:600;color:#111827;line-height:1.3">Пластинчатый<br>теплообменник</div>
    </button>

  </div>

</div>

<!-- Modals -->
<div id="btp-modal-overlay" onclick="btpModalClose()" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.55);z-index:9998"></div>

<div id="btp-modal" style="display:none;position:fixed;top:50%;left:50%;transform:translate(-50%,-50%);background:#fff;border-radius:16px;padding:32px;max-width:560px;width:90%;z-index:9999;box-shadow:0 20px 60px rgba(0,0,0,.25)">
  <button onclick="btpModalClose()" style="position:absolute;top:12px;right:16px;background:none;border:none;font-size:1.4em;cursor:pointer;color:#6b7280;line-height:1">×</button>
  <div style="display:flex;gap:24px;align-items:flex-start">
    <div id="btp-modal-icon" style="flex-shrink:0;width:80px;height:80px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:2.4em"></div>
    <div>
      <h3 id="btp-modal-title" style="font-size:1.3em;font-weight:700;color:#111827;margin:0 0 10px"></h3>
      <p id="btp-modal-text" style="color:#374151;line-height:1.7;margin:0;font-size:.95em"></p>
    </div>
  </div>
</div>

<script>
var btpData = {
  flowmeter: {
    icon: "🔵",
    bg: "#eff6ff",
    title: "Расходомер-счётчик",
    text: "Предназначен для измерения среднего объёмного расхода и объёма теплоносителя, протекающего в трубопроводе. ВТП Инжиниринг применяет поверенные теплосчётчики, соответствующие требованиям коммерческого учёта тепловой энергии."
  },
  filter: {
    icon: "🟢",
    bg: "#f0fdf4",
    title: "Фильтр сетчатый",
    text: "Осуществляет механическую очистку теплоносителя от посторонних включений и загрязнений. Защищает теплообменники и насосы от преждевременного износа, обеспечивая надёжную работу всей системы."
  },
  pump: {
    icon: "🟡",
    bg: "#fef9c3",
    title: "Насос циркуляционный",
    text: "Обеспечивает принудительную циркуляцию теплоносителя в контурах отопления и горячего водоснабжения. Подбирается индивидуально под параметры каждого объекта — производительность, напор, энергопотребление."
  },
  drive: {
    icon: "🟣",
    bg: "#fdf4ff",
    title: "Электропривод",
    text: "Управляющий орган регулирующего клапана. Получает сигнал от контроллера системы автоматизации, обрабатывает данные датчиков и подаёт аналоговый сигнал управления, обеспечивая точное регулирование температуры."
  },
  valve: {
    icon: "🔴",
    bg: "#fff1f2",
    title: "Кран шаровый фланцевый",
    text: "Запорная арматура для надёжного перекрытия трубопроводов. Применяется на узлах ввода и в обвязке оборудования. Обеспечивает герметичное перекрытие при техническом обслуживании и аварийных ситуациях."
  },
  hx: {
    icon: "🟠",
    bg: "#fff7ed",
    title: "Пластинчатый теплообменник",
    text: "Основной теплообменный аппарат БТП. Передаёт тепловую энергию от первичного контура (тепловая сеть) к вторичному (отопление и ГВС), обеспечивая гидравлическое разделение контуров и защиту от загрязнений."
  }
};
function btpModal(key) {
  var d = btpData[key];
  document.getElementById("btp-modal-title").textContent = d.title;
  document.getElementById("btp-modal-text").textContent = d.text;
  document.getElementById("btp-modal-icon").textContent = d.icon;
  document.getElementById("btp-modal-icon").style.background = d.bg;
  document.getElementById("btp-modal").style.display = "block";
  document.getElementById("btp-modal-overlay").style.display = "block";
}
function btpModalClose() {
  document.getElementById("btp-modal").style.display = "none";
  document.getElementById("btp-modal-overlay").style.display = "none";
}
</script>

';

        // Insert before "Этапы работы"
        $newContent = str_replace(
            '<h2 style="font-size:1.4em;font-weight:700;color:#111827;margin:32px 0 16px">Этапы работы</h2>',
            $equipmentSection . '<h2 style="font-size:1.4em;font-weight:700;color:#111827;margin:32px 0 16px">Этапы работы</h2>',
            $content
        );

        DB::table('pages')->where('slug', 'blochnyy-teplovoy-punkt')->update([
            'content' => $newContent,
        ]);
    }

    public function down(): void {}
};
