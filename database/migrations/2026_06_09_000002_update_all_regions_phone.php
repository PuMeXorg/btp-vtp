<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

return new class extends Migration
{
    public function up(): void
    {
        // Все регионы с телефоном 648-48-07
        DB::table('regions')
            ->where('phone_display', 'LIKE', '%648-48-07%')
            ->update([
                'phone_display' => '+7 (991) 987-79-47',
                'phone' => '+79919877947',
                'updated_at' => now(),
            ]);

        // Все регионы с телефоном 162-25-05
        DB::table('regions')
            ->where('phone_display', 'LIKE', '%162-25-05%')
            ->update([
                'phone_display' => '+7 (991) 987-79-47',
                'phone' => '+79919877947',
                'updated_at' => now(),
            ]);

        // Сброс кэша всех регионов
        Cache::forget('regions_all');
        $regions = DB::table('regions')->pluck('slug');
        foreach ($regions as $slug) {
            Cache::forget('region_' . $slug);
        }
    }

    public function down(): void
    {
        // Откат всех регионов обратно на 162-25-05
        DB::table('regions')
            ->where('phone_display', '+7 (991) 987-79-47')
            ->update([
                'phone_display' => '+7 (495) 162-25-05',
                'phone' => '+74951622505',
                'updated_at' => now(),
            ]);

        Cache::forget('regions_all');
        $regions = DB::table('regions')->pluck('slug');
        foreach ($regions as $slug) {
            Cache::forget('region_' . $slug);
        }
    }
};
