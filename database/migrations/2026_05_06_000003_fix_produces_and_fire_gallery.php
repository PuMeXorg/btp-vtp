<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Заменить "проектирует" на "производит" на всех страницах
        $pages = DB::table('pages')->get();
        foreach ($pages as $page) {
            if ($page->content && str_contains($page->content, 'проектирует')) {
                DB::table('pages')->where('id', $page->id)->update([
                    'content'    => str_replace('проектирует', 'производит', $page->content),
                    'updated_at' => now(),
                ]);
            }
        }

        // 2. Обновить галерею на странице пожаротушения: новые файлы + квадраты 200×200
        $fire = DB::table('pages')->where('slug', 'nasosnye-stantsii-pozharotusheniya')->first();
        if ($fire && $fire->content) {
            $content = $fire->content;

            // Новые имена файлов
            $content = str_replace(
                [
                    '/public/images/fire/stancia1.jpg',
                    '/public/images/fire/stancia2.jpg',
                    '/public/images/fire/stancia3.jpg',
                    '/public/images/fire/stancia4.jpg',
                ],
                [
                    '/public/images/fire/stancia1.png',
                    '/public/images/fire/stancia2.webp',
                    '/public/images/fire/stancia3.jpeg',
                    '/public/images/fire/stancia4.jpeg',
                ],
                $content
            );

            // Сетка: 4 колонки вместо 2
            $content = str_replace(
                'grid-template-columns:repeat(2,1fr)',
                'grid-template-columns:repeat(auto-fill,minmax(200px,1fr))',
                $content
            );

            // Квадратные фото вместо 3/4
            $content = str_replace(
                'aspect-ratio:3/4;object-fit:cover;object-position:center top',
                'aspect-ratio:1/1;object-fit:cover',
                $content
            );

            DB::table('pages')->where('slug', 'nasosnye-stantsii-pozharotusheniya')->update([
                'content'    => $content,
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void {}
};
