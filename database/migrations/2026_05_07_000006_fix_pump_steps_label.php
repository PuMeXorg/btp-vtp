<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $pns  = file_get_contents(__DIR__ . '/pns_page_content.html');
        $fire = file_get_contents(__DIR__ . '/fire_page_content.html');

        DB::table('pages')->where('slug', 'povysitelnye-nasosnye-stantsii')
            ->update(['content' => $pns, 'updated_at' => now()]);

        DB::table('pages')->where('slug', 'nasosnye-stantsii-pozharotusheniya')
            ->update(['content' => $fire, 'updated_at' => now()]);
    }

    public function down(): void {}
};
