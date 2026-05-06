<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $content = file_get_contents(__DIR__ . '/ctp_page_content.html');
        $slug = 'tsentralnyy-teplovoy-punkt';

        $existing = DB::table('pages')->where('slug', $slug)->first();
        if ($existing) {
            DB::table('pages')->where('slug', $slug)->update([
                'title'      => 'Центральные тепловые пункты (ЦТП)',
                'content'    => $content,
                'excerpt'    => 'Проектирование, производство и монтаж центральных тепловых пунктов под ключ. ЦТП для жилых кварталов, промышленных и коммерческих объектов.',
                'type'       => 'service',
                'is_active'  => true,
                'sort'       => 6,
                'updated_at' => now(),
            ]);
        } else {
            DB::table('pages')->insert([
                'slug'       => $slug,
                'title'      => 'Центральные тепловые пункты (ЦТП)',
                'content'    => $content,
                'excerpt'    => 'Проектирование, производство и монтаж центральных тепловых пунктов под ключ. ЦТП для жилых кварталов, промышленных и коммерческих объектов.',
                'type'       => 'service',
                'parent_id'  => null,
                'is_active'  => true,
                'sort'       => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        DB::table('pages')->where('slug', 'tsentralnyy-teplovoy-punkt')->delete();
    }
};
