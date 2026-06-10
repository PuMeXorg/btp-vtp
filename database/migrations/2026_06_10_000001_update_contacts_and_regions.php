<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('settings')
            ->where('key', 'default_phone')
            ->update([
                'value' => '+7 (800) 301-95-01',
                'updated_at' => now(),
            ]);

        DB::table('regions')
            ->where(function ($query) {
                $query->where('phone', '+79919877947')
                    ->orWhere('phone_display', '+7 (991) 987-79-47');
            })
            ->update([
                'phone' => '+78003019501',
                'phone_display' => '+7 (800) 301-95-01',
                'updated_at' => now(),
            ]);

        DB::table('regions')
            ->where('slug', 'samara')
            ->update([
                'is_active' => false,
                'updated_at' => now(),
            ]);

        DB::table('regions')
            ->where('slug', 'spb')
            ->update([
                'is_active' => true,
                'updated_at' => now(),
            ]);

        foreach (['pages', 'homepage_blocks'] as $table) {
            DB::table($table)
                ->where('content', 'like', '%+7 (991) 987-79-47%')
                ->update([
                    'content' => DB::raw("REPLACE(content, '+7 (991) 987-79-47', '+7 (800) 301-95-01')"),
                    'updated_at' => now(),
                ]);

            DB::table($table)
                ->where('content', 'like', '%+79919877947%')
                ->update([
                    'content' => DB::raw("REPLACE(content, '+79919877947', '+78003019501')"),
                    'updated_at' => now(),
                ]);
        }

        $this->clearContactCache();
    }

    public function down(): void
    {
        DB::table('settings')
            ->where('key', 'default_phone')
            ->where('value', '+7 (800) 301-95-01')
            ->update([
                'value' => '+7 (991) 987-79-47',
                'updated_at' => now(),
            ]);

        DB::table('regions')
            ->where(function ($query) {
                $query->where('phone', '+78003019501')
                    ->orWhere('phone_display', '+7 (800) 301-95-01');
            })
            ->update([
                'phone' => '+79919877947',
                'phone_display' => '+7 (991) 987-79-47',
                'updated_at' => now(),
            ]);

        DB::table('regions')
            ->whereIn('slug', ['samara', 'spb'])
            ->update([
                'is_active' => true,
                'updated_at' => now(),
            ]);

        foreach (['pages', 'homepage_blocks'] as $table) {
            DB::table($table)
                ->where('content', 'like', '%+7 (800) 301-95-01%')
                ->update([
                    'content' => DB::raw("REPLACE(content, '+7 (800) 301-95-01', '+7 (991) 987-79-47')"),
                    'updated_at' => now(),
                ]);

            DB::table($table)
                ->where('content', 'like', '%+78003019501%')
                ->update([
                    'content' => DB::raw("REPLACE(content, '+78003019501', '+79919877947')"),
                    'updated_at' => now(),
                ]);
        }

        $this->clearContactCache();
    }

    private function clearContactCache(): void
    {
        Cache::forget('setting_default_phone');
        Cache::forget('regions_all');

        foreach (DB::table('regions')->pluck('slug') as $slug) {
            Cache::forget('region_' . $slug);
        }
    }
};
