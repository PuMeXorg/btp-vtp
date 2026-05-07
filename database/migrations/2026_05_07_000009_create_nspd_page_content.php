<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $content = file_get_contents(__DIR__ . '/nspd_page_content.html');

        DB::table('pages')
            ->where('slug', 'nasosnye-stantsii-podderzhania-davlenia')
            ->update(['content' => $content, 'updated_at' => now()]);
    }

    public function down(): void {}
};
