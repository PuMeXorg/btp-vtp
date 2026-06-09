<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // default_phone в настройках
        DB::table('settings')->where('key', 'default_phone')->update([
            'value' => '+7 (991) 987-79-47',
            'updated_at' => now(),
        ]);

        // Телефон региона Москва
        DB::table('regions')->where('slug', 'moscow')->update([
            'phone' => '+79919877947',
            'phone_display' => '+7 (991) 987-79-47',
            'updated_at' => now(),
        ]);

        // Замена старого номера в HTML-контенте страниц
        DB::table('pages')
            ->where('content', 'LIKE', '%648-48-07%')
            ->update([
                'content' => DB::raw("REPLACE(content, '+7 (495) 648-48-07', '+7 (991) 987-79-47')"),
                'updated_at' => now(),
            ]);
        DB::table('pages')
            ->where('content', 'LIKE', '%4956484807%')
            ->update([
                'content' => DB::raw("REPLACE(content, '+74956484807', '+79919877947')"),
                'updated_at' => now(),
            ]);

        cache()->forget('region_moscow');
    }

    public function down(): void
    {
        DB::table('settings')->where('key', 'default_phone')->update([
            'value' => '+7 (495) 648-48-07',
            'updated_at' => now(),
        ]);

        DB::table('regions')->where('slug', 'moscow')->update([
            'phone' => '+74951622505',
            'phone_display' => '+7 (495) 162-25-05',
            'updated_at' => now(),
        ]);

        DB::table('pages')
            ->where('content', 'LIKE', '%987-79-47%')
            ->update([
                'content' => DB::raw("REPLACE(content, '+7 (991) 987-79-47', '+7 (495) 648-48-07')"),
                'updated_at' => now(),
            ]);
        DB::table('pages')
            ->where('content', 'LIKE', '%9919877947%')
            ->update([
                'content' => DB::raw("REPLACE(content, '+79919877947', '+74956484807')"),
                'updated_at' => now(),
            ]);

        cache()->forget('region_moscow');
    }
};
