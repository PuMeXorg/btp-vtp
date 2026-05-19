<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Москва — zakaz@vtp-inz.ru (без изменений)
        // Все остальные регионы — region@vtp-inz.ru
        DB::table('regions')
            ->where('slug', '!=', 'moscow')
            ->update(['email' => 'region@vtp-inz.ru', 'updated_at' => now()]);

        DB::table('regions')
            ->where('slug', 'moscow')
            ->update(['email' => 'zakaz@vtp-inz.ru', 'updated_at' => now()]);

        // Settings.default_email — fallback при "Все регионы"
        DB::table('settings')->updateOrInsert(
            ['key' => 'default_email'],
            ['value' => 'zakaz@vtp-inz.ru', 'updated_at' => now()]
        );

        Cache::forget('regions_all');
        foreach (DB::table('regions')->pluck('slug') as $slug) {
            Cache::forget('region_' . $slug);
        }
    }

    public function down(): void {}
};
