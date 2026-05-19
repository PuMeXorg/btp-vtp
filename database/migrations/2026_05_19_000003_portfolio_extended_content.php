<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('portfolio')->where('slug', 'itp-koptevskaya-65')->update([
            'content' => '<p style="font-size:1.05em;color:#374151;line-height:1.75">ИТП в бизнес-центре по адресу: Москва, Коптевская улица, 65. Выполнили полный цикл работ: проектирование, согласование с ПАО МОЭК, изготовление, монтаж и пусконаладка теплового пункта.</p>

<h2 style="font-size:1.4em;font-weight:700;color:#111827;margin:32px 0 16px">Фотогалерея</h2>
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:12px;margin-bottom:32px">
  <img src="/public/images/portfolio/itp-koptevskaya-65/52aa6bf00797096d378b53881ea1a1dc.jpg" alt="ИТП Коптевская, 65" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-koptevskaya-65/5ad0c56562fdab23536dce0a1e7c3fb4.jpg" alt="ИТП Коптевская, 65" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-koptevskaya-65/5d14eeacbc1a30eb36d33d7b3c1fca13.jpg" alt="ИТП Коптевская, 65" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-koptevskaya-65/61713c77f2f2ff464606c668f9859782.jpg" alt="ИТП Коптевская, 65" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-koptevskaya-65/92badcf6cc8b25e6e67f598c74b9870b.jpg" alt="ИТП Коптевская, 65" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-koptevskaya-65/9f58c262bb34835815e8496da473297b.jpg" alt="ИТП Коптевская, 65" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-koptevskaya-65/aeed9981f48bf135ff20de7941572339.jpg" alt="ИТП Коптевская, 65" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-koptevskaya-65/c28a5dceeb409855c6a1fb2d5f30d793.jpg" alt="ИТП Коптевская, 65" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-koptevskaya-65/e6672453ea93e781ccf7d84ae76a958c.jpg" alt="ИТП Коптевская, 65" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-koptevskaya-65/f4f8c5a577216348c7b5b82d591a65aa.jpg" alt="ИТП Коптевская, 65" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
</div>
',
            'updated_at' => now(),
        ]);
        DB::table('portfolio')->where('slug', 'itp-simferopolskiy-7')->update([
            'content' => '<p style="font-size:1.05em;color:#374151;line-height:1.75">ИТП в жилом комплексе по адресу: Москва, Симферопольский проезд, владение 7. Произведён комплекс работ от проектирования до сдачи в теплоснабжающую организацию и Ростехнадзор.</p>

<h2 style="font-size:1.4em;font-weight:700;color:#111827;margin:32px 0 16px">Фотогалерея</h2>
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:12px;margin-bottom:32px">
  <img src="/public/images/portfolio/itp-simferopolskiy-7/0ef68e0ecca0eae09f58ae1e9f32dcac.jpg" alt="ИТП Симферопольский проезд, влд 7" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-simferopolskiy-7/193bffcd39ab199f0c2f47d8591b3e98.jpg" alt="ИТП Симферопольский проезд, влд 7" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-simferopolskiy-7/32eee11c65daa6366c2f0b2b2b9a7f06.jpg" alt="ИТП Симферопольский проезд, влд 7" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-simferopolskiy-7/3541ddfa19c03ece9f9db33c202c624a.jpg" alt="ИТП Симферопольский проезд, влд 7" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-simferopolskiy-7/4a4a1d622667013311ddde0dbf597af2.jpg" alt="ИТП Симферопольский проезд, влд 7" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-simferopolskiy-7/9c72c9cf1fe1888b54e399d79ac888da.jpg" alt="ИТП Симферопольский проезд, влд 7" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-simferopolskiy-7/c176853e328f4167ca3ececdf352dca9.jpg" alt="ИТП Симферопольский проезд, влд 7" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-simferopolskiy-7/c85f0b76d5d4f27f4ab6f906c31f7726.jpg" alt="ИТП Симферопольский проезд, влд 7" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-simferopolskiy-7/cd9f1f653d9d65424d432e6f1b3856b0.jpg" alt="ИТП Симферопольский проезд, влд 7" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-simferopolskiy-7/f1fd0b6308a5ab7c77261fcc744b4640.jpg" alt="ИТП Симферопольский проезд, влд 7" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-simferopolskiy-7/f2ccac11cadda9e5ab1e58d962f5805c.jpg" alt="ИТП Симферопольский проезд, влд 7" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
</div>
',
            'updated_at' => now(),
        ]);
        DB::table('portfolio')->where('slug', 'itp-feodosiyskaya-7k2')->update([
            'content' => '<p style="font-size:1.05em;color:#374151;line-height:1.75">ИТП в жилом доме по адресу: Москва, Феодосийская, владение 7 корпус 2. Выполнили полный цикл: разработка проектной документации, изготовление блочного теплового пункта, монтаж и пусконаладка.</p>

<h2 style="font-size:1.4em;font-weight:700;color:#111827;margin:32px 0 16px">Фотогалерея</h2>
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:12px;margin-bottom:32px">
  <img src="/public/images/portfolio/itp-feodosiyskaya-7k2/0cb75c03d721729d2afdc97ccdb32fcd.jpg" alt="ИТП Феодосийская, влд 7 к2" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-feodosiyskaya-7k2/3a693fb5b32d15e967cbdd9e751f7f21.jpg" alt="ИТП Феодосийская, влд 7 к2" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-feodosiyskaya-7k2/3e61b2e1726ef0dec456d0546301cc97.jpg" alt="ИТП Феодосийская, влд 7 к2" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-feodosiyskaya-7k2/411483f6c3294cd9ff81b3ba5ac7cc23.jpg" alt="ИТП Феодосийская, влд 7 к2" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-feodosiyskaya-7k2/76497453f4311f54112f1244e8b702f4.jpg" alt="ИТП Феодосийская, влд 7 к2" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-feodosiyskaya-7k2/816568397d6d3bba8b614f3173c5a81b.jpg" alt="ИТП Феодосийская, влд 7 к2" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-feodosiyskaya-7k2/91efab00688205d39e1bb81bd037bfef.jpg" alt="ИТП Феодосийская, влд 7 к2" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-feodosiyskaya-7k2/caacd986ad1d61a3ef3b465b7fe54ae2.jpg" alt="ИТП Феодосийская, влд 7 к2" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-feodosiyskaya-7k2/daedbd27e6734143c10be93be066d84f.jpg" alt="ИТП Феодосийская, влд 7 к2" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
</div>
',
            'updated_at' => now(),
        ]);
        DB::table('portfolio')->where('slug', 'itp-yushunskaya-1')->update([
            'content' => '<p style="font-size:1.05em;color:#374151;line-height:1.75">ИТП в жилом здании по адресу: Москва, Малая Юшуньская улица, 1. Реализован проект с подбором оборудования под параметры объекта и сдачей в эксплуатирующую организацию.</p>

<h2 style="font-size:1.4em;font-weight:700;color:#111827;margin:32px 0 16px">Фотогалерея</h2>
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:12px;margin-bottom:32px">
  <img src="/public/images/portfolio/itp-yushunskaya-1/2a03412a1a865d264a28535f620b5ce1.jpg" alt="ИТП Малая Юшуньская, 1" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-yushunskaya-1/90d1d9e822b2915f78ee12062d6f6262.jpg" alt="ИТП Малая Юшуньская, 1" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-yushunskaya-1/9b6607d843fb0eba88f9683a190eb8e0.jpg" alt="ИТП Малая Юшуньская, 1" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-yushunskaya-1/a31f94ac8612720a245b040e35bfdf25.jpg" alt="ИТП Малая Юшуньская, 1" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
</div>
',
            'updated_at' => now(),
        ]);
        DB::table('portfolio')->where('slug', 'itp-lytkarino')->update([
            'content' => '<p style="font-size:1.05em;color:#374151;line-height:1.75">ИТП в жилом доме посёлка Лыткарино, 6 микрорайон, корпус 1, Московская область. Полный цикл работ — от ТУ и проектирования до пусконаладки.</p>

<h2 style="font-size:1.4em;font-weight:700;color:#111827;margin:32px 0 16px">Фотогалерея</h2>
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:12px;margin-bottom:32px">
  <img src="/public/images/portfolio/itp-lytkarino/01f482ef8dfd33b306552fceab2cf2b3.jpg" alt="ИТП пос. Лыткарино, 6 микрорайон, корпус 1" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-lytkarino/1aff9e20fa26f6764e941a872a072985.jpg" alt="ИТП пос. Лыткарино, 6 микрорайон, корпус 1" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-lytkarino/7f732ad9e234d7026ce42cc2071aee44.jpg" alt="ИТП пос. Лыткарино, 6 микрорайон, корпус 1" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-lytkarino/8b6bbb1db2fed03d13b158186fddebfb.jpg" alt="ИТП пос. Лыткарино, 6 микрорайон, корпус 1" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-lytkarino/bd6a7bf314f63fc8ee97d161c45074ed.jpg" alt="ИТП пос. Лыткарино, 6 микрорайон, корпус 1" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-lytkarino/cd7bdd008f5930ccd3f8a56241989a6e.jpg" alt="ИТП пос. Лыткарино, 6 микрорайон, корпус 1" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-lytkarino/f262f561288dfd50b3a4480ce1c560e0.jpg" alt="ИТП пос. Лыткарино, 6 микрорайон, корпус 1" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-lytkarino/fa6552093626b016c378cab09224b1c6.jpg" alt="ИТП пос. Лыткарино, 6 микрорайон, корпус 1" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
</div>
',
            'updated_at' => now(),
        ]);
        DB::table('portfolio')->where('slug', 'itp-balashikha')->update([
            'content' => '<p style="font-size:1.05em;color:#374151;line-height:1.75">ИТП в жилом корпусе по адресу: Балашиха, улица Твардовского, 26. Произведён комплекс работ по проектированию, монтажу и сдаче ИТП.</p>

<h2 style="font-size:1.4em;font-weight:700;color:#111827;margin:32px 0 16px">Фотогалерея</h2>
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:12px;margin-bottom:32px">
  <img src="/public/images/portfolio/itp-balashikha/0efa62800871811e801c74bee9a99e3b.jpg" alt="ИТП Балашиха, ул. Твардовского, 26" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-balashikha/129c94b7a437972548782ac83a5d0439.jpg" alt="ИТП Балашиха, ул. Твардовского, 26" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-balashikha/1a861397ce27a4af919eb481798b218b.jpg" alt="ИТП Балашиха, ул. Твардовского, 26" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-balashikha/2307814447d000467457791ea035df6d.jpg" alt="ИТП Балашиха, ул. Твардовского, 26" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-balashikha/6f647c9c4952750c4ed62e436f8389e9.jpg" alt="ИТП Балашиха, ул. Твардовского, 26" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-balashikha/c99c065600dc05addd20e861b0e2596a.jpg" alt="ИТП Балашиха, ул. Твардовского, 26" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-balashikha/e293de82c64679c2ea2d3a17a7e05739.jpg" alt="ИТП Балашиха, ул. Твардовского, 26" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
</div>
',
            'updated_at' => now(),
        ]);
        DB::table('portfolio')->where('slug', 'itp-gazgoldernaya-8')->update([
            'content' => '<p style="font-size:1.05em;color:#374151;line-height:1.75">ИТП в здании многофункционального назначения по адресу: Москва, улица Газгольдерная, 8 строение 8. Выполнили полный цикл от проектирования до сдачи в эксплуатацию.</p>

<h2 style="font-size:1.4em;font-weight:700;color:#111827;margin:32px 0 16px">Фотогалерея</h2>
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:12px;margin-bottom:32px">
  <img src="/public/images/portfolio/itp-gazgoldernaya-8/084f69b33be27bdca7000e55b574c222.jpg" alt="ИТП ул. Газгольдерная, 8 стр. 8" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-gazgoldernaya-8/230510fa720f98d9d39d9d00e76d3bf0.jpg" alt="ИТП ул. Газгольдерная, 8 стр. 8" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-gazgoldernaya-8/56a8d071594c001ef47fd023a3167846.jpg" alt="ИТП ул. Газгольдерная, 8 стр. 8" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-gazgoldernaya-8/5a54920597ab13c066cbf7bf2485cca6.jpg" alt="ИТП ул. Газгольдерная, 8 стр. 8" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/itp-gazgoldernaya-8/e429f799c6106e1be5e05a4bf1f5d6b2.jpg" alt="ИТП ул. Газгольдерная, 8 стр. 8" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
</div>
',
            'updated_at' => now(),
        ]);
        DB::table('portfolio')->where('slug', 'shkaf-danfoss')->update([
            'content' => '<p style="font-size:1.05em;color:#374151;line-height:1.75">Шкаф управления группой циркуляционных насосов с частотными преобразователями Danfoss. Реализованы автоматическое регулирование производительности, защита и резервирование, диспетчеризация по протоколам Modbus / Ethernet.</p>

<h2 style="font-size:1.4em;font-weight:700;color:#111827;margin:32px 0 16px">Фотогалерея</h2>
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:12px;margin-bottom:32px">
  <img src="/public/images/portfolio/shkaf-danfoss/23e6dd21b449ca34a06ca6164948e912.jpg" alt="Шкаф управления насосами с ЧП Danfoss" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/shkaf-danfoss/7945e7c800388fe2ead57b4521f623f0.jpg" alt="Шкаф управления насосами с ЧП Danfoss" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/shkaf-danfoss/86fe8e85c7d3f7f2bf2a410bb1eb5ecc.jpg" alt="Шкаф управления насосами с ЧП Danfoss" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/shkaf-danfoss/989328951d67048e802cd39cda93ff4c.jpg" alt="Шкаф управления насосами с ЧП Danfoss" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/shkaf-danfoss/e427065d1abb65e31c45f3a57aba6cc7.jpg" alt="Шкаф управления насосами с ЧП Danfoss" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/shkaf-danfoss/e867a1ce4914dedacc15e3e6b7f11c51.jpg" alt="Шкаф управления насосами с ЧП Danfoss" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/shkaf-danfoss/fa997b56e095c7f56bf81e3b8b4deca4.jpg" alt="Шкаф управления насосами с ЧП Danfoss" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
</div>
',
            'updated_at' => now(),
        ]);
        DB::table('portfolio')->where('slug', 'shkaf-regada')->update([
            'content' => '<p style="font-size:1.05em;color:#374151;line-height:1.75">Шкаф управления электроприводом регулирующей арматуры Regada STO. Спроектирован и собран под параметры объекта, выполнено программирование контроллера и пусконаладка.</p>

<h2 style="font-size:1.4em;font-weight:700;color:#111827;margin:32px 0 16px">Фотогалерея</h2>
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:12px;margin-bottom:32px">
  <img src="/public/images/portfolio/shkaf-regada/0478b5f3c1870a6cefd6fd95dcd97bb8.jpg" alt="Шкаф управления электроприводом Regada STO" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/shkaf-regada/227201fcb42a84182ff6a078ae72b405.jpg" alt="Шкаф управления электроприводом Regada STO" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
</div>
',
            'updated_at' => now(),
        ]);
        DB::table('portfolio')->where('slug', 'dk-klenovo')->update([
            'content' => '<p style="font-size:1.05em;color:#374151;line-height:1.75">Шкаф автоматики для инженерных систем дворца культуры «Кленово». Реализован комплекс задач: управление вентиляцией, отоплением, регулирование параметров теплоносителя, аварийная сигнализация.</p>

<h2 style="font-size:1.4em;font-weight:700;color:#111827;margin:32px 0 16px">Фотогалерея</h2>
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:12px;margin-bottom:32px">
  <img src="/public/images/portfolio/dk-klenovo/208ccfe42bbc7e9bc17e99a5ba7d1b10.jpg" alt="ДК «Кленово»" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/dk-klenovo/284babe254a56ef6f14259a573ab2215.jpg" alt="ДК «Кленово»" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/dk-klenovo/38a775178a5c3c87ceb8c71a978ea1a3.jpg" alt="ДК «Кленово»" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/dk-klenovo/3d0d6ee00789c2fb5bd3e854867f3a10.jpg" alt="ДК «Кленово»" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/dk-klenovo/4b518cf3e857a53aadfeb92cd08a1a12.jpg" alt="ДК «Кленово»" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/dk-klenovo/4c62f7519ca11f90abe44ba91efaa760.jpg" alt="ДК «Кленово»" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/dk-klenovo/5019325f6ec1a4db9394005d00b37d17.jpg" alt="ДК «Кленово»" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/dk-klenovo/507bb9a384604ce01d39a3b7c4345d76.jpg" alt="ДК «Кленово»" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/dk-klenovo/5a3b13f753718d9dfaf0ac388a486f02.jpg" alt="ДК «Кленово»" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/dk-klenovo/a01db0a60da99075f26f0a1e640bc56a.jpg" alt="ДК «Кленово»" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/dk-klenovo/c655b9f391c17c03810107046c9c750c.jpg" alt="ДК «Кленово»" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/dk-klenovo/c90d32a511d52731321cb3f33a1f875d.jpg" alt="ДК «Кленово»" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/dk-klenovo/d9b0b409d99d8ef30ae4043ef732dba2.jpg" alt="ДК «Кленово»" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
</div>
',
            'updated_at' => now(),
        ]);
        DB::table('portfolio')->where('slug', 'zhk-klenovo')->update([
            'content' => '<p style="font-size:1.05em;color:#374151;line-height:1.75">Шкаф автоматики для инженерных систем жилого комплекса «Кленово». Подбор оборудования под параметры объекта, программирование контроллера, монтаж и интеграция в общую систему диспетчеризации.</p>

<h2 style="font-size:1.4em;font-weight:700;color:#111827;margin:32px 0 16px">Фотогалерея</h2>
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:12px;margin-bottom:32px">
  <img src="/public/images/portfolio/zhk-klenovo/0df07431344da1d537253e14f6c4213c.jpg" alt="ЖК «Кленово»" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/zhk-klenovo/26d1b13bfecc4249300bb4f9f628445e.jpg" alt="ЖК «Кленово»" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/zhk-klenovo/3046adb9082326d264c9a559bb9f5fbc.jpg" alt="ЖК «Кленово»" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/zhk-klenovo/3c2592bbb25d6fc9d8a93c4fc9e99bcd.jpg" alt="ЖК «Кленово»" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/zhk-klenovo/3f80382966a3e97559713dca0838b1a0.jpg" alt="ЖК «Кленово»" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/zhk-klenovo/538ce1df2ba8601982fc6d29bed85bb5.jpg" alt="ЖК «Кленово»" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/zhk-klenovo/57f0c60ce9e824ebd91600c81e191121.jpg" alt="ЖК «Кленово»" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/zhk-klenovo/73f8a760f2b0145902177ccdc74905b3.jpg" alt="ЖК «Кленово»" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/zhk-klenovo/7455cea1a4fd78d1f3f895ea87f026ea.jpg" alt="ЖК «Кленово»" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/zhk-klenovo/be932ccba9b30a48f13d2d815ad55a6a.jpg" alt="ЖК «Кленово»" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/zhk-klenovo/c4c4f8bb584eb6784d8e08c5b96a0b2f.jpg" alt="ЖК «Кленово»" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/zhk-klenovo/f8f6fb730fedaa4146843cdcb8831576.jpg" alt="ЖК «Кленово»" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
  <img src="/public/images/portfolio/zhk-klenovo/fbcf76b4e9799fde67eb5532bada466d.jpg" alt="ЖК «Кленово»" style="width:100%;border-radius:10px;aspect-ratio:4/3;object-fit:cover">
</div>
',
            'updated_at' => now(),
        ]);
    }

    public function down(): void {}
};
