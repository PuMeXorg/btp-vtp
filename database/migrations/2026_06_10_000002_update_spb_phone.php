<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('regions')
            ->where('slug', 'spb')
            ->update([
                'phone' => '+78003019501',
                'phone_display' => '+7 (800) 301-95-01',
                'updated_at' => now(),
            ]);

        Cache::forget('regions_all');
        Cache::forget('region_spb');
    }

    public function down(): void
    {
        DB::table('regions')
            ->where('slug', 'spb')
            ->where('phone', '+78003019501')
            ->update([
                'phone' => '+78122000000',
                'phone_display' => '+7 (812) 200-00-00',
                'updated_at' => now(),
            ]);

        Cache::forget('regions_all');
        Cache::forget('region_spb');
    }
};
