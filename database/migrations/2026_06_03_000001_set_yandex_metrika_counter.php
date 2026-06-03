<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('settings')
            ->where('key', 'yandex_metrika')
            ->update([
                'value'      => '109607430',
                'updated_at' => now(),
            ]);
    }

    public function down(): void
    {
        DB::table('settings')
            ->where('key', 'yandex_metrika')
            ->update([
                'value'      => '',
                'updated_at' => now(),
            ]);
    }
};
