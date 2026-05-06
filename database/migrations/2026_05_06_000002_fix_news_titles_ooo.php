<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('news')->where('id', '<=', 10)->get()->each(function ($item) {
            $title = str_replace('ВТП Инжиниринг подписало', 'ООО «ВТП Инжиниринг» подписало', $item->title);
            DB::table('news')->where('id', $item->id)->update([
                'title'      => $title,
                'updated_at' => now(),
            ]);
        });
    }

    public function down(): void {}
};
