<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Фикс битых фото в разделе «Производство электрощитового оборудования».
     * В БД пути были записаны как .jpg, а реальные файлы лежат с другими
     * расширениями (.jpeg / .png) — из-за чего 3 карточки шкафов не грузились.
     */
    private array $fix = [
        'shkafy-upravleniya-drenazhnymi-nasosami' => '/public/images/elektro/asu-dn/1.jpeg',
        'stantsiya-upravleniya-nasosami-su-pp'    => '/public/images/elektro/su-pp/1.png',
        'avtomatizatsiya-kotelnykh'               => '/public/images/elektro/kotel/1.png',
    ];

    public function up(): void
    {
        foreach ($this->fix as $slug => $img) {
            DB::table('pages')->where('slug', $slug)->update([
                'image'      => $img,
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        foreach (array_keys($this->fix) as $slug) {
            $wrong = '/public/images/elektro/'
                . [
                    'shkafy-upravleniya-drenazhnymi-nasosami' => 'asu-dn',
                    'stantsiya-upravleniya-nasosami-su-pp'    => 'su-pp',
                    'avtomatizatsiya-kotelnykh'               => 'kotel',
                ][$slug] . '/1.jpg';
            DB::table('pages')->where('slug', $slug)->update([
                'image'      => $wrong,
                'updated_at' => now(),
            ]);
        }
    }
};
