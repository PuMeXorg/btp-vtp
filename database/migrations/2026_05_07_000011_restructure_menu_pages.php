<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Переименовать "Монтаж под ключ" → "Монтаж и пусконаладка под ключ"
        DB::table('pages')
            ->where('slug', 'montazh-pod-klyuch')
            ->update(['title' => 'Монтаж и пусконаладка под ключ', 'updated_at' => now()]);

        // 2. Скрыть "Пусконаладка"
        DB::table('pages')
            ->where('slug', 'puskonaladka')
            ->update(['is_active' => false, 'updated_at' => now()]);

        // 3. Обновить контент "Монтаж БТП"
        $montazhContent = file_get_contents(__DIR__ . '/montazh_btp_content.html');
        DB::table('pages')
            ->where('slug', 'montazh-btp-pod-klyuch')
            ->update(['content' => $montazhContent, 'updated_at' => now()]);

        // 4. Обновить контент "Проектирование"
        $proektContent = file_get_contents(__DIR__ . '/proektirovanie_content.html');
        DB::table('pages')
            ->where('slug', 'proektirovanie')
            ->update(['content' => $proektContent, 'updated_at' => now()]);

        // 5. Скрыть "Автоматизация ИТП и ЦТП" и всех детей
        $parent = DB::table('pages')->where('slug', 'avtomatizatsiya-itp-i-tstp')->first();
        if ($parent) {
            DB::table('pages')
                ->where('id', $parent->id)
                ->orWhere('parent_id', $parent->id)
                ->update(['is_active' => false, 'updated_at' => now()]);
        }
    }

    public function down(): void {}
};
