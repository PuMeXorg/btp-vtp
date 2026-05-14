<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        // Пункт 5: скрыть "Проектирование, монтаж, пусконаладка" и подпункты
        DB::table('pages')
            ->whereIn('slug', [
                'montazh-pod-klyuch',
                'montazh-btp-pod-klyuch',
                'montazh-nasosnykh-stantsiy-pod-klyuch',
            ])
            ->update(['is_active' => false, 'updated_at' => now()]);

        // Пункт 6: активировать страницу "Проектирование"
        $exists = DB::table('pages')->where('slug', 'proektirovanie')->exists();
        if ($exists) {
            DB::table('pages')->where('slug', 'proektirovanie')->update([
                'is_active' => true,
                'parent_id' => null,
                'updated_at' => now(),
            ]);
        } else {
            DB::table('pages')->insert([
                'slug' => 'proektirovanie',
                'title' => 'Проектирование',
                'type' => 'service',
                'content' => '<p>Проектирование тепловых пунктов, насосных станций, электрощитового оборудования и систем автоматизации. Полный цикл — от технических условий до согласования и сдачи объекта.</p>',
                'excerpt' => 'Проектирование инженерных систем под ключ.',
                'is_active' => true,
                'parent_id' => null,
                'sort' => 99,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void {}
};
