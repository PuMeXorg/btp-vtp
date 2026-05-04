<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $page = DB::table('pages')->where('slug', 'blochnyy-teplovoy-punkt')->first();
        if (!$page) return;

        // Replace old hotspot section with FA-icon version
        $content = preg_replace(
            '/<h2[^>]*>Какое оборудование входит в состав БТП\?<\/h2>.*?(<h2[^>]*>Этапы работы<\/h2>)/s',
            '$1',
            $page->content
        );

        $section = '
<h2 style="font-size:1.5em;font-weight:700;color:#111827;margin:40px 0 6px;text-align:center">Какое оборудование входит в состав БТП?</h2>
<p style="text-align:center;color:#6b7280;margin-bottom:24px;font-size:.9em">Нажмите на метку, чтобы узнать подробнее</p>

<div style="position:relative;max-width:680px;margin:0 auto 40px;user-select:none">
  <img src="/public/images/about/btp-3d.jpg" alt="Состав блочного теплового пункта" style="width:100%;border-radius:16px;display:block;box-shadow:0 8px 32px rgba(0,0,0,.15)">

  <button onclick="btpShow(\'hx\')" title="Пластинчатый теплообменник" style="position:absolute;left:33%;top:53%;transform:translate(-50%,-50%);background:none;border:none;cursor:pointer;padding:0;z-index:10">
    <span style="display:flex;align-items:center;justify-content:center;width:26px;height:26px;background:#cc0000;border-radius:50%;box-shadow:0 0 0 5px rgba(204,0,0,.2),0 0 0 10px rgba(204,0,0,.08);animation:btpPulse 2s ease-in-out infinite">
      <i class="fas fa-fire-flame-curved" style="color:#fff;font-size:.65em"></i>
    </span>
  </button>

  <button onclick="btpShow(\'pump\')" title="Насосы циркуляционные" style="position:absolute;left:68%;top:80%;transform:translate(-50%,-50%);background:none;border:none;cursor:pointer;padding:0;z-index:10">
    <span style="display:flex;align-items:center;justify-content:center;width:26px;height:26px;background:#2563eb;border-radius:50%;box-shadow:0 0 0 5px rgba(37,99,235,.2),0 0 0 10px rgba(37,99,235,.08);animation:btpPulse 2s ease-in-out infinite .3s">
      <i class="fas fa-gears" style="color:#fff;font-size:.65em"></i>
    </span>
  </button>

  <button onclick="btpShow(\'panel\')" title="Щит автоматизации" style="position:absolute;left:80%;top:43%;transform:translate(-50%,-50%);background:none;border:none;cursor:pointer;padding:0;z-index:10">
    <span style="display:flex;align-items:center;justify-content:center;width:26px;height:26px;background:#7c3aed;border-radius:50%;box-shadow:0 0 0 5px rgba(124,58,237,.2),0 0 0 10px rgba(124,58,237,.08);animation:btpPulse 2s ease-in-out infinite .6s">
      <i class="fas fa-microchip" style="color:#fff;font-size:.65em"></i>
    </span>
  </button>

  <button onclick="btpShow(\'filter\')" title="Фильтр грязевой" style="position:absolute;left:21%;top:27%;transform:translate(-50%,-50%);background:none;border:none;cursor:pointer;padding:0;z-index:10">
    <span style="display:flex;align-items:center;justify-content:center;width:26px;height:26px;background:#16a34a;border-radius:50%;box-shadow:0 0 0 5px rgba(22,163,74,.2),0 0 0 10px rgba(22,163,74,.08);animation:btpPulse 2s ease-in-out infinite .9s">
      <i class="fas fa-filter" style="color:#fff;font-size:.65em"></i>
    </span>
  </button>

  <button onclick="btpShow(\'drive\')" title="Электроприводы" style="position:absolute;left:54%;top:9%;transform:translate(-50%,-50%);background:none;border:none;cursor:pointer;padding:0;z-index:10">
    <span style="display:flex;align-items:center;justify-content:center;width:26px;height:26px;background:#ea580c;border-radius:50%;box-shadow:0 0 0 5px rgba(234,88,12,.2),0 0 0 10px rgba(234,88,12,.08);animation:btpPulse 2s ease-in-out infinite 1.2s">
      <i class="fas fa-bolt" style="color:#fff;font-size:.65em"></i>
    </span>
  </button>

  <button onclick="btpShow(\'tank\')" title="Расширительный бак" style="position:absolute;left:52%;top:32%;transform:translate(-50%,-50%);background:none;border:none;cursor:pointer;padding:0;z-index:10">
    <span style="display:flex;align-items:center;justify-content:center;width:26px;height:26px;background:#0891b2;border-radius:50%;box-shadow:0 0 0 5px rgba(8,145,178,.2),0 0 0 10px rgba(8,145,178,.08);animation:btpPulse 2s ease-in-out infinite 1.5s">
      <i class="fas fa-database" style="color:#fff;font-size:.65em"></i>
    </span>
  </button>

  <button onclick="btpShow(\'gauge\')" title="Манометры и термометры" style="position:absolute;left:16%;top:51%;transform:translate(-50%,-50%);background:none;border:none;cursor:pointer;padding:0;z-index:10">
    <span style="display:flex;align-items:center;justify-content:center;width:26px;height:26px;background:#ca8a04;border-radius:50%;box-shadow:0 0 0 5px rgba(202,138,4,.2),0 0 0 10px rgba(202,138,4,.08);animation:btpPulse 2s ease-in-out infinite 1.8s">
      <i class="fas fa-gauge-high" style="color:#fff;font-size:.65em"></i>
    </span>
  </button>

</div>

<style>
@keyframes btpPulse {
  0%,100% { opacity:1; transform:scale(1); }
  50% { opacity:.85; transform:scale(1.12); }
}
</style>

<!-- Overlay -->
<div id="btp-overlay" onclick="btpClose()" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:9998;backdrop-filter:blur(2px)"></div>

<!-- Popup -->
<div id="btp-popup" style="display:none;position:fixed;top:50%;left:50%;transform:translate(-50%,-50%);background:#fff;border-radius:20px;max-width:500px;width:92%;z-index:9999;box-shadow:0 24px 80px rgba(0,0,0,.3);overflow:hidden">
  <div id="btp-popup-header" style="padding:24px 24px 20px;display:flex;align-items:center;gap:16px">
    <div id="btp-popup-icon-wrap" style="width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:1.5em"></div>
    <div style="flex:1;min-width:0">
      <div id="btp-popup-title" style="font-size:1.15em;font-weight:700;color:#111827"></div>
      <div id="btp-popup-sub" style="font-size:.82em;color:#6b7280;margin-top:2px"></div>
    </div>
    <button onclick="btpClose()" style="background:#f3f4f6;border:none;border-radius:50%;width:32px;height:32px;cursor:pointer;font-size:1.1em;color:#6b7280;display:flex;align-items:center;justify-content:center;flex-shrink:0;line-height:1">
      <i class="fas fa-xmark"></i>
    </button>
  </div>
  <div style="height:1px;background:#f3f4f6;margin:0 24px"></div>
  <div id="btp-popup-text" style="padding:20px 24px;color:#374151;line-height:1.75;font-size:.93em"></div>
  <div id="btp-popup-props" style="padding:0 24px 24px;display:flex;flex-wrap:wrap;gap:8px"></div>
</div>

<script>
var _btpData = {
  hx: {
    faIcon: "fa-fire-flame-curved", bg: "#fff1f0", color: "#cc0000",
    title: "Пластинчатый теплообменник",
    sub: "Основной теплообменный аппарат",
    text: "Обеспечивает передачу тепловой энергии от первичного контура тепловой сети к вторичному контуру объекта. Разборная конструкция позволяет легко обслуживать и чистить пластины. Гидравлически разделяет контуры, защищая внутренние системы объекта.",
    props: ["Нержавеющие пластины","Разборная конструкция","КПД до 98%","Давление до 16 бар"]
  },
  pump: {
    faIcon: "fa-gears", bg: "#eff6ff", color: "#2563eb",
    title: "Насосы циркуляционные",
    sub: "Группа насосов отопления и ГВС",
    text: "Обеспечивают принудительную циркуляцию теплоносителя в контурах отопления и горячего водоснабжения. Подбираются индивидуально по производительности и напору под параметры каждого объекта. Предусмотрен резервный насос с автоматическим переключением.",
    props: ["Рабочий + резервный","Частотный привод","Энергосберегающий режим","Автопереключение"]
  },
  panel: {
    faIcon: "fa-microchip", bg: "#f5f3ff", color: "#7c3aed",
    title: "Щит автоматизации",
    sub: "Система управления и контроля",
    text: "Программируемый контроллер получает сигналы от датчиков температуры и давления, обрабатывает их и управляет электроприводами клапанов и насосами. Поддерживает дистанционный мониторинг и диспетчеризацию через GSM или Ethernet.",
    props: ["Программируемый ПЛК","Сенсорный HMI-экран","Диспетчеризация","Аварийная сигнализация"]
  },
  filter: {
    faIcon: "fa-filter", bg: "#f0fdf4", color: "#16a34a",
    title: "Фильтр грязевой",
    sub: "Механическая очистка теплоносителя",
    text: "Осуществляет механическую очистку теплоносителя от посторонних включений, окалины и загрязнений перед поступлением в теплообменник и насосы. Продлевает срок службы всего оборудования БТП и предотвращает засорение пластин теплообменника.",
    props: ["Тонкость очистки 500 мкм","Чугун / нержавеющая сталь","Фланцевое присоединение","Дренажный вентиль"]
  },
  drive: {
    faIcon: "fa-bolt", bg: "#fff7ed", color: "#ea580c",
    title: "Электроприводы клапанов",
    sub: "Исполнительные механизмы регулирования",
    text: "Управляют положением регулирующих клапанов по команде контроллера. Плавно изменяют расход теплоносителя для поддержания заданной температуры в контурах отопления и ГВС. Получают аналоговый сигнал 0–10 В от щита автоматизации.",
    props: ["Сигнал 0–10 В / 4–20 мА","Ручное управление","Индикатор положения","Защита IP54"]
  },
  tank: {
    faIcon: "fa-database", bg: "#ecfeff", color: "#0891b2",
    title: "Расширительный бак",
    sub: "Компенсация теплового расширения",
    text: "Компенсирует увеличение объёма теплоносителя при нагреве в закрытых контурах системы отопления. Поддерживает постоянное рабочее давление в системе и предотвращает срабатывание предохранительных клапанов при штатной работе.",
    props: ["Мембранная конструкция","Предзаряд азотом","Объём подбирается по контуру","Давление до 10 бар"]
  },
  gauge: {
    faIcon: "fa-gauge-high", bg: "#fefce8", color: "#ca8a04",
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
  var wrap = document.getElementById("btp-popup-icon-wrap");
  wrap.style.background = d.bg;
  wrap.innerHTML = "<i class=\"fas " + d.faIcon + "\" style=\"color:" + d.color + "\"></i>";
  document.getElementById("btp-popup-title").textContent = d.title;
  document.getElementById("btp-popup-sub").textContent = d.sub;
  document.getElementById("btp-popup-text").textContent = d.text;
  var pr = document.getElementById("btp-popup-props");
  pr.innerHTML = d.props.map(function(p){
    return "<span style=\"background:#f3f4f6;border-radius:20px;padding:4px 12px;font-size:.8em;color:#374151;font-weight:500\"><i class=\"fas fa-check\" style=\"color:#16a34a;margin-right:5px\"></i>" + p + "</span>";
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
            $section . '<h2 style="font-size:1.4em;font-weight:700;color:#111827;margin:32px 0 16px">Этапы работы</h2>',
            $content
        );

        DB::table('pages')->where('slug', 'blochnyy-teplovoy-punkt')->update([
            'content' => $newContent,
        ]);
    }

    public function down(): void {}
};
