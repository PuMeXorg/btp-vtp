<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $map = [
            'vvodno-raspredelitelnye-ustroystva'              => 'vru',
            'shkafy-avtomatiki-ventilyatsii'                  => 'shav',
            'shkafy-upravleniya-nasosami'                     => 'shun',
            'schity-upravleniya-chastotnymi-elektroprivodami' => 'shu-che',
            'shkafy-upravleniya-drenazhnymi-nasosami'         => 'asu-dn',
            'stantsiya-upravleniya-nasosami-su-pp'            => 'su-pp',
            'avtomaticheskie-stantsii-upravleniya-nasosami'   => 'asu',
            'shkaf-upravleniya-elektrozadvizhkoy'             => 'shuz',
            'shkafy-avr'                                      => 'avr',
            'raspredelitelnye-shkafy'                         => 'shr',
            'shkaf-upravleniya-pozharotusheniem'              => 'asu-pt',
            'avtomatizatsiya-kotelnykh'                       => 'kotel',
            'stantsii-upravleniya-su-che'                     => 'su-che',
            'schity-avtomaticheskogo-pereklyucheniya-na-rezerv' => 'shap',
        ];

        foreach ($map as $slug => $folder) {
            $page = DB::table('pages')->where('slug', $slug)->first();
            if (! $page) continue;

            $gallery = '<div style="margin-top:40px">'
                . '<h3 style="font-size:1.15em;font-weight:700;color:#111827;margin-bottom:16px">Фотогалерея</h3>'
                . '<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:12px">';

            for ($i = 1; $i <= 3; $i++) {
                $src = "/public/images/elektro/{$folder}/{$i}.jpg";
                $gallery .= '<div style="border-radius:10px;overflow:hidden;aspect-ratio:4/3;background:#f1f5f9">'
                    . "<img src=\"{$src}\" alt=\"\" loading=\"lazy\" "
                    . 'style="width:100%;height:100%;object-fit:cover;display:block">'
                    . '</div>';
            }

            $gallery .= '</div></div>';

            // Не дублируем, если галерея уже есть
            if (str_contains($page->content ?? '', 'Фотогалерея')) continue;

            DB::table('pages')->where('slug', $slug)->update([
                'content'    => ($page->content ?? '') . $gallery,
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void {}
};
