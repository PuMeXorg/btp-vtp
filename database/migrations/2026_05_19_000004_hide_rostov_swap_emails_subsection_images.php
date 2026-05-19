<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Скрыть регион Ростов
        DB::table('regions')->where('slug', 'rostov')->update([
            'is_active' => false,
            'updated_at' => now(),
        ]);

        // 2. Поменять default_email на zakaz@vtp-inz.ru
        DB::table('settings')->where('key', 'default_email')->update([
            'value' => 'zakaz@vtp-inz.ru',
            'updated_at' => now(),
        ]);

        // 2b. В контенте всех страниц заменить вхождения teplovoy-punkt.ru email
        $pages = DB::table('pages')->where('content', 'LIKE', '%zakaz@teplovoy-punkt.ru%')->get(['id', 'content']);
        foreach ($pages as $p) {
            DB::table('pages')->where('id', $p->id)->update([
                'content' => str_replace('zakaz@teplovoy-punkt.ru', 'zakaz@vtp-inz.ru', $p->content),
                'updated_at' => now(),
            ]);
        }

        // 3. Фото для подразделов услуг
        $images = [
            // Тепловые пункты
            'individualnyy-teplovoy-punkt' => '/public/images/about/itp1.jpg',
            'tsentralnyy-teplovoy-punkt' => '/public/images/ctp/ctp_main.jpg',
            'blochnyy-teplovoy-punkt' => '/public/images/about/itp1.jpg',
            // Насосные станции
            'avtomaticheskie-ustanovki-podderzhania-davleniya' => '/public/images/nspd/aypd.jpeg',
            'nasosnye-stantsii-podderzhania-davlenia' => '/public/images/nspd/nspd1.jpg',
            // Электрощитовое оборудование (14)
            'shkafy-upravleniya-nasosami' => '/public/images/elektro/shun/1.jpg',
            'shkafy-upravleniya-drenazhnymi-nasosami' => '/public/images/elektro/asu-dn/1.jpg',
            'stantsiya-upravleniya-nasosami-su-pp' => '/public/images/elektro/su-pp/1.jpg',
            'avtomaticheskie-stantsii-upravleniya-nasosami' => '/public/images/elektro/asu/1.jpg',
            'vvodno-raspredelitelnye-ustroystva' => '/public/images/elektro/vru/1.jpg',
            'shkafy-avtomatiki-ventilyatsii' => '/public/images/elektro/shav/1.jpg',
            'schity-upravleniya-chastotnymi-elektroprivodami' => '/public/images/elektro/shu-che/1.jpg',
            'shkaf-upravleniya-elektrozadvizhkoy' => '/public/images/elektro/shuz/1.jpg',
            'shkafy-avr' => '/public/images/elektro/avr/1.jpg',
            'raspredelitelnye-shkafy' => '/public/images/elektro/shr/1.jpg',
            'shkaf-upravleniya-pozharotusheniem' => '/public/images/elektro/asu-pt/1.jpg',
            'avtomatizatsiya-kotelnykh' => '/public/images/elektro/kotel/1.jpg',
            'stantsii-upravleniya-su-che' => '/public/images/elektro/su-che/1.jpg',
            'schity-avtomaticheskogo-pereklyucheniya-na-rezerv' => '/public/images/elektro/shap/1.jpg',
        ];
        foreach ($images as $slug => $img) {
            DB::table('pages')->where('slug', $slug)->update([
                'image' => $img,
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void {}
};
