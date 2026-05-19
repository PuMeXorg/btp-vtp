<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Скрыть все варианты Ростова
        DB::table('regions')
            ->where(function ($q) {
                $q->where('slug', 'rostov')
                    ->orWhere('slug', 'rostov-na-donu')
                    ->orWhere('name', 'like', 'Ростов%');
            })
            ->update(['is_active' => false, 'updated_at' => now()]);

        // Нормализовать email на zakaz@vtp-inz.ru для всех регионов кроме Москвы
        // (у Москвы уже стоит правильный, не трогаем)
        DB::table('regions')
            ->where('slug', '!=', 'moscow')
            ->where(function ($q) {
                $q->where('email', 'like', '%teplovoy-punkt.ru%')
                    ->orWhere('email', 'like', '%@company.ru%')
                    ->orWhere('email', 'like', '%region@%')
                    ->orWhereNull('email')
                    ->orWhere('email', '');
            })
            ->update(['email' => 'zakaz@vtp-inz.ru', 'updated_at' => now()]);

        // Сбросить кэш RegionHelper
        Cache::forget('regions_all');
        foreach (DB::table('regions')->pluck('slug') as $slug) {
            Cache::forget('region_' . $slug);
        }
    }

    public function down(): void {}
};
