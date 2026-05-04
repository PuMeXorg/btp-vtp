<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $page = DB::table('pages')->where('slug', 'blochnyy-teplovoy-punkt')->first();
        if (!$page) return;

        // Remove previous equipment section
        $content = preg_replace(
            '/<h2[^>]*>Какое оборудование входит в состав БТП\?<\/h2>.*?(<h2[^>]*>Этапы работы<\/h2>)/s',
            '$1',
            $page->content
        );

        $hotspotSection = '
<h2 style="font-size:1.5em;font-weight:700;color:#111827;margin:40px 0 6px;text-align:center">Какое оборудование входит в состав БТП?</h2>
<p style="text-align:center;color:#6b7280;margin-bottom:24px;font-size:.9em">Нажмите на метку, чтобы узнать подробнее</p>

<div style="position:relative;max-width:680px;margin:0 auto 40px;user-select:none">
  <img src="/public/images/about/btp-3d.jpg" alt="Состав блочного теплового пункта" style="width:100%;border-radius:16px;display:block;box-shadow:0 8px 32px rgba(0,0,0,.15)">

  <!-- Пластинчатый теплообменник — красный блок по центру -->
  <button onclick="btpShow(\'hx\')" style="position:absolute;left:33%;top:53%;transform:translate(-50%,-50%);background:none;border:none;cursor:pointer;padding:0;z-index:10">
    <span style="display:block;width:22px;height:22px;background:#cc0000;border-radius:50%;box-shadow:0 0 0 4px rgba(204,0,0,.25),0 0 0 8px rgba(204,0,0,.1);animation:btpPulse 2s infinite"></span>
  </button>

  <!-- Циркуляционные насосы — синие внизу справа -->
  <button onclick="btpShow(\'pump\')" style="position:absolute;left:68%;top:80%;transform:translate(-50%,-50%);background:none;border:none;cursor:pointer;padding:0;z-index:10">
    <span style="display:block;width:22px;height:22px;background:#2563eb;border-radius:50%;box-shadow:0 0 0 4px rgba(37,99,235,.25),0 0 0 8px rgba(37,99,235,.1);animation:btpPulse 2s infinite .3s"></span>
  </button>

  <!-- Щит автоматизации — серый шкаф справа -->
  <button onclick="btpShow(\'panel\')" style="position:absolute;left:80%;top:43%;transform:translate(-50%,-50%);background:none;border:none;cursor:pointer;padding:0;z-index:10">
    <span style="display:block;width:22px;height:22px;background:#7c3aed;border-radius:50%;box-shadow:0 0 0 4px rgba(124,58,237,.25),0 0 0 8px rgba(124,58,237,.1);animation:btpPulse 2s infinite .6s"></span>
  </button>

  <!-- Фильтр сетчатый — цилиндр вверху слева -->
  <button onclick="btpShow(\'filter\')" style="position:absolute;left:21%;top:27%;transform:translate(-50%,-50%);background:none;border:none;cursor:pointer;padding:0;z-index:10">
    <span style="display:block;width:22px;height:22px;background:#16a34a;border-radius:50%;box-shadow:0 0 0 4px rgba(22,163,74,.25),0 0 0 8px rgba(22,163,74,.1);animation:btpPulse 2s infinite .9s"></span>
  </button>

  <!-- Электроприводы — чёрные клапаны вверху -->
  <button onclick="btpShow(\'drive\')" style="position:absolute;left:54%;top:9%;transform:translate(-50%,-50%);background:none;border:none;cursor:pointer;padding:0;z-index:10">
    <span style="display:block;width:22px;height:22px;background:#ea580c;border-radius:50%;box-shadow:0 0 0 4px rgba(234,88,12,.25),0 0 0 8px rgba(234,88,12,.1);animation:btpPulse 2s infinite 1.2s"></span>
  </button>

  <!-- Расширительный бак — белый цилиндр по центру -->
  <button onclick="btpShow(\'tank\')" style="position:absolute;left:52%;top:32%;transform:translate(-50%,-50%);background:none;border:none;cursor:pointer;padding:0;z-index:10">
    <span style="display:block;width:22px;height:22px;background:#0891b2;border-radius:50%;box-shadow:0 0 0 4px rgba(8,145,178,.25),0 0 0 8px rgba(8,145,178,.1);animation:btpPulse 2s infinite 1.5s"></span>
  </button>

  <!-- Манометр — слева -->
  <button onclick="btpShow(\'gauge\')" style="position:absolute;left:16%;top:51%;transform:translate(-50%,-50%);background:none;border:none;cursor:pointer;padding:0;z-index:10">
    <span style="display:block;width:22px;height:22px;background:#ca8a04;border-radius:50%;box-shadow:0 0 0 4px rgba(202,138,4,.25),0 0 0 8px rgba(202,138,4,.1);animation:btpPulse 2s infinite 1.8s"></span>
  </button>

</div>

<style>
@keyframes btpPulse {
  0%,100% { box-shadow:0 0 0 4px rgba(var(--pc),.3),0 0 0 8px rgba(var(--pc),.1); }
  50% { box-shadow:0 0 0 6px rgba(var(--pc),.15),0 0 0 12px rgba(var(--pc),.05); }
}
</style>

<!-- Tooltip popup -->
<div id="btp-overlay" onclick="btpClose()" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:9998;backdrop-filter:blur(2px)"></div>
<div id="btp-popup" style="display:none;position:fixed;top:50%;left:50%;transform:translate(-50%,-50%);background:#fff;border-radius:20px;padding:0;max-width:500px;width:92%;z-index:9999;box-shadow:0 24px 80px rgba(0,0,0,.3);overflow:hidden">
  <div id="btp-popup-header" style="padding:24px 24px 20px;display:flex;align-items:center;gap:16px">
    <div id="btp-popup-icon" style="width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.8em;flex-shrink:0"></div>
    <div>
      <div id="btp-popup-title" style="font-size:1.2em;font-weight:700;color:#111827"></div>
      <div id="btp-popup-sub" style="font-size:.82em;color:#6b7280;margin-top:2px"></div>
    </div>
    <button onclick="btpClose()" style="margin-left:auto;background:#f3f4f6;border:none;border-radius:50%;width:32px;height:32px;cursor:pointer;font-size:1.1em;color:#6b7280;display:flex;align-items:center;justify-content:center;flex-shrink:0">×</button>
  </div>
  <div style="height:1px;background:#f3f4f6;margin:0 24px"></div>
  <div id="btp-popup-text" style="padding:20px 24px;color:#374151;line-height:1.75;font-size:.93em"></div>
  <div id="btp-popup-props" style="padding:0 24px 20px;display:flex;flex-wrap:wrap;gap:8px"></div>
</div>

<script>
var _btpData = {
  hx: {
    icon: "♨️", bg: "#fff1f0", color: "#cc0000",
    title: "Пластинчатый теплообменник",
    sub: "Основной теплообменный аппарат",
    text: "Обеспечивает передачу тепловой энергии от первичного контура тепловой сети к вторичному контуру объекта. Разборная конструкция позволяет легко обслуживать и чистить пластины. Гидравлически разделяет контуры, защищая внутренние системы объекта.",
    props: ["Нержавеющие пластины","Разборная конструкция","КПД до 98%","Давление до 16 бар"]
  },
  pump: {
    icon: "⚙️", bg: "#eff6ff", color: "#2563eb",
    title: "Насосы циркуляционные",
    sub: "Группа насосов отопления и ГВС",
    text: "Обеспечивают принудительную циркуляцию теплоносителя в контурах отопления и горячего водоснабжения. Подбираются индивидуально по производительности и напору под параметры каждого объекта. Предусмотрен резервный насос с автоматическим переключением.",
    props: ["Рабочий + резервный","Частотный привод","Энергосберегающий режим","Автопереключение"]
  },
  panel: {
    icon: "🖥️", bg: "#f5f3ff", color: "#7c3aed",
    title: "Щит автоматизации",
    sub: "Система управления и контроля",
    text: "Программируемый контроллер получает сигналы от датчиков температуры и давления, обрабатывает их и управляет электроприводами клапанов и насосами. Поддерживает дистанционный мониторинг и диспетчеризацию через GSM или Ethernet.",
    props: ["Программируемый ПЛК","Сенсорный HMI-экран","Диспетчеризация","Аварийная сигнализация"]
  },
  filter: {
    icon: "🔵", bg: "#f0fdf4", color: "#16a34a",
    title: "Фильтр грязевой",
    sub: "Механическая очистка теплоносителя",
    text: "Осуществляет механическую очистку теплоносителя от посторонних включений, окалины и загрязнений перед поступлением в теплообменник и насосы. Продлевает срок службы всего оборудования БТП и предотвращает засорение пластин теплообменника.",
    props: ["Тонкость очистки 500 мкм","Чугун / нержавеющая сталь","Фланцевое присоединение","Дренажный вентиль"]
  },
  drive: {
    icon: "🔧", bg: "#fff7ed", color: "#ea580c",
    title: "Электроприводы клапанов",
    sub: "Исполнительные механизмы регулирования",
    text: "Управляют положением регулирующих клапанов по команде контроллера. Плавно изменяют расход теплоносителя для поддержания заданной температуры в контурах отопления и ГВС. Получают аналоговый сигнал 0–10 В от щита автоматизации.",
    props: ["Сигнал 0–10 В / 4–20 мА","Ручное управление","Индикатор положения","Защита IP54"]
  },
  tank: {
    icon: "🛢️", bg: "#ecfeff", color: "#0891b2",
    title: "Расширительный бак",
    sub: "Компенсация теплового расширения",
    text: "Компенсирует увеличение объёма теплоносителя при нагреве в закрытых контурах системы отопления. Поддерживает постоянное рабочее давление в системе и предотвращает срабатывание предохранительных клапанов при штатной работе.",
    props: ["Мембранная конструкция","Предзаряд азотом","Объём подбирается по контуру","Рабочее давление до 10 бар"]
  },
  gauge: {
    icon: "📊", bg: "#fefce8", color: "#ca8a04",
    title: "Манометры и термометры",
    sub: "Приборы контроля параметров",
    text: "Обеспечивают визуальный контроль давления и температуры теплоносителя в узловых точках системы. Устанавливаются на входе, выходе и в межконтурных соединениях. Позволяют персоналу оперативно оценивать состояние системы без подключения к щиту.",
    props: ["Класс точности 1,6","Диапазон до 16 бар","Биметаллический термометр","На каждом узле ввода"]
  }
};
function btpShow(k) {
  var d = _btpData[k];
  var h = document.getElementById("btp-popup-header");
  h.style.background = d.bg;
  document.getElementById("btp-popup-icon").textContent = d.icon;
  document.getElementById("btp-popup-title").textContent = d.title;
  document.getElementById("btp-popup-sub").textContent = d.sub;
  document.getElementById("btp-popup-text").textContent = d.text;
  var pr = document.getElementById("btp-popup-props");
  pr.innerHTML = d.props.map(function(p){
    return "<span style=\"background:#f3f4f6;border-radius:20px;padding:4px 12px;font-size:.8em;color:#374151;font-weight:500\">✓ "+p+"</span>";
  }).join("");
  document.getElementById("btp-popup").style.display = "block";
  document.getElementById("btp-overlay").style.display = "block";
}
function btpClose() {
  document.getElementById("btp-popup").style.display = "none";
  document.getElementById("btp-overlay").style.display = "none";
}
document.addEventListener("keydown", function(e){ if(e.key==="Escape") btpClose(); });
</script>

';

        $newContent = str_replace(
            '<h2 style="font-size:1.4em;font-weight:700;color:#111827;margin:32px 0 16px">Этапы работы</h2>',
            $hotspotSection . '<h2 style="font-size:1.4em;font-weight:700;color:#111827;margin:32px 0 16px">Этапы работы</h2>',
            $content
        );

        DB::table('pages')->where('slug', 'blochnyy-teplovoy-punkt')->update([
            'content' => $newContent,
        ]);
    }

    public function down(): void {}
};
