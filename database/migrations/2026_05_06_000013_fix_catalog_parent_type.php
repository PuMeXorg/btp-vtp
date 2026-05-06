<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('pages')->where('id', 13)->update([
            'type'       => 'service',
            'updated_at' => now(),
        ]);

        // Убедимся, что дочерние страницы тоже type=service
        DB::table('pages')->where('parent_id', 13)->update([
            'type'       => 'service',
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        DB::table('pages')->where('id', 13)->update(['type' => 'catalog']);
    }
};
