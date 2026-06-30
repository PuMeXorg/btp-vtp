<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('settings')
            ->where('key', 'default_phone')
            ->update([
                'value' => '+7 991 987 79 47',
                'updated_at' => now(),
            ]);

        DB::table('regions')->update([
            'phone' => '+79919877947',
            'phone_display' => '+7 991 987 79 47',
            'updated_at' => now(),
        ]);

        foreach (['pages', 'homepage_blocks', 'news'] as $table) {
            if (! Schema::hasTable($table)) {
                continue;
            }

            foreach (['content', 'excerpt', 'meta_description'] as $column) {
                if (! Schema::hasColumn($table, $column)) {
                    continue;
                }

                DB::table($table)
                    ->where($column, 'like', '%+7 (800) 301-95-01%')
                    ->update([
                        $column => DB::raw("REPLACE({$column}, '+7 (800) 301-95-01', '+7 991 987 79 47')"),
                        'updated_at' => now(),
                    ]);

                DB::table($table)
                    ->where($column, 'like', '%8-800-301-95-01%')
                    ->update([
                        $column => DB::raw("REPLACE({$column}, '8-800-301-95-01', '+7 991 987 79 47')"),
                        'updated_at' => now(),
                    ]);

                DB::table($table)
                    ->where($column, 'like', '%+78003019501%')
                    ->update([
                        $column => DB::raw("REPLACE({$column}, '+78003019501', '+79919877947')"),
                        'updated_at' => now(),
                    ]);
            }
        }

        $this->clearContactCache();
    }

    public function down(): void
    {
        DB::table('settings')
            ->where('key', 'default_phone')
            ->where('value', '+7 991 987 79 47')
            ->update([
                'value' => '+7 (800) 301-95-01',
                'updated_at' => now(),
            ]);

        DB::table('regions')
            ->where('phone', '+79919877947')
            ->update([
                'phone' => '+78003019501',
                'phone_display' => '+7 (800) 301-95-01',
                'updated_at' => now(),
            ]);

        foreach (['pages', 'homepage_blocks', 'news'] as $table) {
            if (! Schema::hasTable($table)) {
                continue;
            }

            foreach (['content', 'excerpt', 'meta_description'] as $column) {
                if (! Schema::hasColumn($table, $column)) {
                    continue;
                }

                DB::table($table)
                    ->where($column, 'like', '%+7 991 987 79 47%')
                    ->update([
                        $column => DB::raw("REPLACE({$column}, '+7 991 987 79 47', '+7 (800) 301-95-01')"),
                        'updated_at' => now(),
                    ]);

                DB::table($table)
                    ->where($column, 'like', '%+79919877947%')
                    ->update([
                        $column => DB::raw("REPLACE({$column}, '+79919877947', '+78003019501')"),
                        'updated_at' => now(),
                    ]);
            }
        }

        $this->clearContactCache();
    }

    private function clearContactCache(): void
    {
        Cache::forget('setting_default_phone');
        Cache::forget('regions_all');

        foreach (DB::table('regions')->pluck('slug') as $slug) {
            Cache::forget('region_'.$slug);
        }
    }
};
