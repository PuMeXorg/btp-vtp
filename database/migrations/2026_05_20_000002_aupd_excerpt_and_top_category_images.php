<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. АУПД — убрать "ХВС, ГВС, отопление" из excerpt
        $row = DB::table('pages')->where('slug', 'avtomaticheskie-ustanovki-podderzhania-davleniya')->first();
        if ($row && $row->excerpt) {
            DB::table('pages')->where('slug', 'avtomaticheskie-ustanovki-podderzhania-davleniya')->update([
                'excerpt' => str_replace(
                    [' ХВС, ГВС, отопление.', 'ХВС, ГВС, отопление.', 'ХВС, ГВС, отопление'],
                    '',
                    $row->excerpt
                ),
                'updated_at' => now(),
            ]);
        }

        // 2. Image для топ-уровневых категорий услуг (для /uslugi)
        $images = [
            'blochnyy-teplovoy-punkt' => '/public/images/about/itp1.jpg',
            'nasosnye-stantsii' => '/public/images/about/povis1.jpeg',
            'teplovye-punkty' => '/public/images/ctp/ctp_main.jpg',
            'proizvodstvo-elektroshchitovogo-oborudovaniya' => '/public/images/elektro/asu/1.jpg',
            'sobstvennoe-proizvodstvo' => '/public/images/about/sotrudniki.jpg',
            'proektirovanie' => '/public/images/about/itp2.jpeg',
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
