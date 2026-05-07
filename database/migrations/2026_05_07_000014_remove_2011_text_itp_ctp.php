<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $itp = file_get_contents(__DIR__ . '/itp_page_content.html');
        DB::table('pages')
            ->where('slug', 'individualnyy-teplovoy-punkt')
            ->update(['content' => $itp, 'updated_at' => now()]);

        $ctp = file_get_contents(__DIR__ . '/ctp_page_content.html');
        DB::table('pages')
            ->where('slug', 'tsentralnyy-teplovoy-punkt')
            ->update(['content' => $ctp, 'updated_at' => now()]);
    }

    public function down(): void {}
};
