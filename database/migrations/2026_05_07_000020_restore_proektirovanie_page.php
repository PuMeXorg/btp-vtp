<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('pages')
            ->where('slug', 'proektirovanie')
            ->update(['is_active' => true, 'updated_at' => now()]);
    }

    public function down(): void {}
};
