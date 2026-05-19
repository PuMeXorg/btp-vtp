<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('portfolio')->delete();

        $items = [
            ['itp-koptevskaya-65', 'ИТП Коптевская, 65', 'Монтаж ИТП', 'Индивидуальный тепловой пункт бизнес-центра.', 'itp-koptevskaya-65.jpg'],
            ['itp-simferopolskiy-7', 'ИТП Симферопольский проезд, влд 7', 'Монтаж ИТП', 'Тепловой пункт жилого комплекса.', 'itp-simferopolskiy-7.jpg'],
            ['itp-feodosiyskaya-7k2', 'ИТП Феодосийская, влд 7 к2', 'Монтаж ИТП', 'Тепловой пункт жилого корпуса.', 'itp-feodosiyskaya-7k2.jpg'],
            ['itp-yushunskaya-1', 'ИТП Малая Юшуньская, 1', 'Монтаж ИТП', 'Индивидуальный тепловой пункт жилого здания.', 'itp-yushunskaya-1.jpg'],
            ['itp-lytkarino', 'ИТП пос. Лыткарино, 6 микрорайон, корпус 1', 'Монтаж ИТП', 'ИТП в подмосковном поселке.', 'itp-lytkarino.jpg'],
            ['itp-balashikha', 'ИТП Балашиха, ул. Твардовского, 26', 'Монтаж ИТП', 'Тепловой пункт жилого корпуса в Балашихе.', 'itp-balashikha.jpg'],
            ['itp-gazgoldernaya-8', 'ИТП ул. Газгольдерная, 8 стр. 8', 'Монтаж ИТП', 'ИТП многофункционального здания.', 'itp-gazgoldernaya-8.jpg'],
            ['shkaf-danfoss', 'Шкаф управления насосами с ЧП Danfoss', 'Шкафы автоматики', 'Автоматизированный шкаф управления насосами с частотными преобразователями Danfoss.', 'shkaf-danfoss.jpg'],
            ['shkaf-regada', 'Шкаф управления электроприводом Regada STO', 'Шкафы автоматики', 'Система управления электроприводом.', 'shkaf-regada.jpg'],
            ['dk-klenovo', 'ДК «Кленово»', 'Шкафы автоматики', 'Автоматика инженерных систем дворца культуры.', 'dk-klenovo.jpg'],
            ['zhk-klenovo', 'ЖК «Кленово»', 'Шкафы автоматики', 'Автоматизация инженерных систем жилого комплекса.', 'zhk-klenovo.jpg'],
        ];

        $now = now();
        $rows = [];
        foreach ($items as $i => [$slug, $title, $category, $excerpt, $img]) {
            $rows[] = [
                'slug' => $slug,
                'title' => $title,
                'category' => $category,
                'excerpt' => $excerpt,
                'content' => '<p>' . $excerpt . '</p>',
                'image' => '/public/images/portfolio/' . $img,
                'is_active' => true,
                'sort' => ($i + 1) * 10,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }
        DB::table('portfolio')->insert($rows);
    }

    public function down(): void {}
};
