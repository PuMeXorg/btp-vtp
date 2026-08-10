<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const PHONE = '+74952231925';

    private const PHONE_DISPLAY = '+7 (495) 223-19-25';

    public function up(): void
    {
        DB::table('settings')
            ->where('key', 'default_phone')
            ->update(['value' => self::PHONE_DISPLAY, 'updated_at' => now()]);

        DB::table('regions')->update([
            'phone' => self::PHONE,
            'phone_display' => self::PHONE_DISPLAY,
            'updated_at' => now(),
        ]);

        $this->replacePublicPhone([
            '+7 (991) 987-79-47',
            '+7 991 987 79 47',
            '+79919877947',
            '+7 (800) 301-95-01',
            '8 800 301-95-01',
            '8-800-301-95-01',
            '+78003019501',
            '+7 (495) 648-48-07',
            '+74956484807',
            '+7 (495) 162-25-05',
            '+74951622505',
        ], self::PHONE_DISPLAY, self::PHONE);

        $this->clearContactCache();
    }

    public function down(): void
    {
        DB::table('settings')
            ->where('key', 'default_phone')
            ->where('value', self::PHONE_DISPLAY)
            ->update(['value' => '+7 991 987 79 47', 'updated_at' => now()]);

        DB::table('regions')
            ->where('phone', self::PHONE)
            ->update([
                'phone' => '+79919877947',
                'phone_display' => '+7 991 987 79 47',
                'updated_at' => now(),
            ]);

        $this->replacePublicPhone(
            [self::PHONE_DISPLAY, self::PHONE],
            '+7 991 987 79 47',
            '+79919877947'
        );

        $this->clearContactCache();
    }

    private function replacePublicPhone(array $oldValues, string $display, string $phone): void
    {
        foreach (['pages', 'homepage_blocks', 'news'] as $table) {
            if (! Schema::hasTable($table)) {
                continue;
            }

            foreach (['content', 'excerpt', 'meta_description'] as $column) {
                if (! Schema::hasColumn($table, $column)) {
                    continue;
                }

                foreach ($oldValues as $oldValue) {
                    $replacement = preg_match('/^\+?\d+$/', $oldValue) ? $phone : $display;

                    DB::table($table)
                        ->where($column, 'like', '%'.$oldValue.'%')
                        ->update([
                            $column => DB::raw("REPLACE({$column}, '".$oldValue."', '".$replacement."')"),
                            'updated_at' => now(),
                        ]);
                }
            }
        }
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
