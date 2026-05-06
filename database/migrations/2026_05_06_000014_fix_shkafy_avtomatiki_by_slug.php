<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Находим реальный id страницы по slug (id=13 может отличаться на сервере)
        $parent = DB::table('pages')->where('slug', 'shkafy-avtomatiki')->first();
        if (! $parent) {
            return;
        }

        $realId = $parent->id;

        // Переименовываем родительскую страницу и делаем её type=service
        DB::table('pages')->where('id', $realId)->update([
            'title'      => 'Производство электрощитового оборудования',
            'type'       => 'service',
            'updated_at' => now(),
        ]);

        // Если дети были вставлены с parent_id=13 (хардкод), переносим их на реальный id
        if ($realId !== 13) {
            DB::table('pages')->where('parent_id', 13)->update([
                'parent_id'  => $realId,
                'type'       => 'service',
                'updated_at' => now(),
            ]);
        }

        // В любом случае убеждаемся, что все дети реального родителя — type=service
        DB::table('pages')->where('parent_id', $realId)->update([
            'type'       => 'service',
            'updated_at' => now(),
        ]);
    }

    public function down(): void {}
};
