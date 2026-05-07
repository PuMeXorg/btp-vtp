<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $map = [
            'vvodno-raspredelitelnye-ustroystva'               => ['vru',     ['1.jpg']],
            'shkafy-avtomatiki-ventilyatsii'                   => ['shav',    ['1.jpg']],
            'shkafy-upravleniya-nasosami'                      => ['shun',    ['1.jpg']],
            'schity-upravleniya-chastotnymi-elektroprivodami'  => ['shu-che', ['1.jpg']],
            'shkafy-upravleniya-drenazhnymi-nasosami'          => ['asu-dn',  ['1.jpeg']],
            'stantsiya-upravleniya-nasosami-su-pp'             => ['su-pp',   ['1.png']],
            'avtomaticheskie-stantsii-upravleniya-nasosami'    => ['asu',     ['1.jpg']],
            'shkaf-upravleniya-elektrozadvizhkoy'              => ['shuz',    ['1.jpg']],
            'shkafy-avr'                                       => ['avr',     ['1.jpg']],
            'raspredelitelnye-shkafy'                          => ['shr',     ['1.jpg']],
            'shkaf-upravleniya-pozharotusheniem'               => ['asu-pt',  ['1.jpg']],
            'avtomatizatsiya-kotelnykh'                        => ['kotel',   ['1.png']],
            'stantsii-upravleniya-su-che'                      => ['su-che',  ['1.jpg']],
            'schity-avtomaticheskogo-pereklyucheniya-na-rezerv' => ['shap',   ['1.jpg']],
        ];

        $galleryStart = '<div style="margin-top:40px"><h3 style="font-size:1.15em;font-weight:700;color:#111827;margin-bottom:16px">Фотогалерея</h3>';

        foreach ($map as $slug => [$folder, $files]) {
            $page = DB::table('pages')->where('slug', $slug)->first();
            if (! $page) continue;

            // Убираем старую галерею
            $content = $page->content ?? '';
            $pos = strpos($content, $galleryStart);
            if ($pos !== false) {
                $content = substr($content, 0, $pos);
            }

            // Строим новую галерею
            $gallery = '<div style="margin-top:40px">'
                . '<h3 style="font-size:1.15em;font-weight:700;color:#111827;margin-bottom:16px">Фотогалерея</h3>'
                . '<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:12px">';

            foreach ($files as $file) {
                $src = "/public/images/elektro/{$folder}/{$file}";
                $gallery .= '<div style="border-radius:10px;overflow:hidden;background:#f1f5f9">'
                    . "<img src=\"{$src}\" alt=\"\" loading=\"lazy\" "
                    . 'style="width:100%;height:auto;display:block">'
                    . '</div>';
            }

            $gallery .= '</div></div>';

            DB::table('pages')->where('slug', $slug)->update([
                'content'    => $content . $gallery,
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void {}
};
