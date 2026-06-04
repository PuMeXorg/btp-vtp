<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Ребрендинг в КОНТЕНТЕ БД: «ВТП Инжиниринг» → «Инженерный комфорт»
     * (тексты страниц, новости, блоки главной). Плюс смена адреса и
     * превью видео на новый логотип.
     */
    public function up(): void
    {
        $this->replaceInTable('pages', ['title', 'excerpt', 'content', 'meta_title', 'meta_description'], 'ВТП Инжиниринг', 'Инженерный комфорт');
        $this->replaceInTable('news', ['title', 'excerpt', 'content'], 'ВТП Инжиниринг', 'Инженерный комфорт');
        $this->replaceInTable('homepage_blocks', null, 'ВТП Инжиниринг', 'Инженерный комфорт');

        DB::table('settings')->where('key', 'default_address')->update([
            'value'      => 'г. Москва, ул. Дорожная, д. 60Ас1',
            'updated_at' => now(),
        ]);

        DB::table('videos')
            ->where('preview', '/public/images/logo-vtp-transparent.png')
            ->update(['preview' => '/public/images/logo-ik-icon.png', 'updated_at' => now()]);
    }

    public function down(): void
    {
        $this->replaceInTable('pages', ['title', 'excerpt', 'content', 'meta_title', 'meta_description'], 'Инженерный комфорт', 'ВТП Инжиниринг');
        $this->replaceInTable('news', ['title', 'excerpt', 'content'], 'Инженерный комфорт', 'ВТП Инжиниринг');
        $this->replaceInTable('homepage_blocks', null, 'Инженерный комфорт', 'ВТП Инжиниринг');

        DB::table('settings')->where('key', 'default_address')->update([
            'value'      => '117041, г. Москва, ул. Адмирала Руднева, д. 4, помещ. 26Н/5',
            'updated_at' => now(),
        ]);

        DB::table('videos')
            ->where('preview', '/public/images/logo-ik-icon.png')
            ->update(['preview' => '/public/images/logo-vtp-transparent.png', 'updated_at' => now()]);
    }

    private function replaceInTable(string $table, ?array $columns, string $from, string $to): void
    {
        foreach (DB::table($table)->get() as $row) {
            $arr  = (array) $row;
            $cols = $columns ?? array_keys($arr);
            $data = [];
            foreach ($cols as $col) {
                if (! array_key_exists($col, $arr)) {
                    continue;
                }
                $val = $arr[$col];
                if (is_string($val) && str_contains($val, $from)) {
                    $data[$col] = str_replace($from, $to, $val);
                }
            }
            if ($data) {
                DB::table($table)->where('id', $row->id)->update($data);
            }
        }
    }
};
