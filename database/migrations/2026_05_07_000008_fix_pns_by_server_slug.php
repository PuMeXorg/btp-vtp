<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $content = file_get_contents(__DIR__ . '/pns_page_content.html');

        // На сервере слаг отличается от локального
        $slugs = [
            'nasosnye-stantsii-podderzhania-davlenia',
            'povysitelnye-nasosnye-stantsii',
        ];

        foreach ($slugs as $slug) {
            $updated = DB::table('pages')->where('slug', $slug)->update([
                'content'    => $content,
                'updated_at' => now(),
            ]);
            if ($updated) break;
        }
    }

    public function down(): void {}
};
