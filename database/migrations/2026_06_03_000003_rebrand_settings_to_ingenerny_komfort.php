<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Ребрендинг ООО «ВТП Инжиниринг» → ООО «Инженерный комфорт».
     * Меняются только настройки бренда в БД. Email/телефон НЕ трогаем —
     * реквизиты ИК ещё не получены (см. changelog, TODO).
     */
    public function up(): void
    {
        $values = [
            'site_name'       => 'Инженерный комфорт',
            'footer_text'     => '© 2026 ООО «Инженерный комфорт». Все права защищены.',
            'default_address' => '117041, г. Москва, ул. Адмирала Руднева, д. 4, помещ. 26Н/5',
        ];
        foreach ($values as $key => $value) {
            DB::table('settings')->where('key', $key)->update([
                'value'      => $value,
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        $values = [
            'site_name'       => 'ВТП Инжиниринг',
            'footer_text'     => '© 2026 ООО «ВТП Инжиниринг». Все права защищены.',
            'default_address' => 'г. Москва, ул. Красная Пресня, д. 28, этаж/офис 3/2',
        ];
        foreach ($values as $key => $value) {
            DB::table('settings')->where('key', $key)->update([
                'value'      => $value,
                'updated_at' => now(),
            ]);
        }
    }
};
