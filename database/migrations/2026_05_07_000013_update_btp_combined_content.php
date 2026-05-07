<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Обновить контент БТП — два раздела: Проектирование + Монтаж
        $content = file_get_contents(__DIR__ . '/montazh_btp_content.html');
        DB::table('pages')
            ->where('slug', 'montazh-btp-pod-klyuch')
            ->update(['content' => $content, 'updated_at' => now()]);

        // Скрыть верхнеуровневый "Проектирование"
        DB::table('pages')
            ->where('slug', 'proektirovanie')
            ->update(['is_active' => false, 'updated_at' => now()]);
    }

    public function down(): void {}
};
