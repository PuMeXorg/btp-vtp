<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    private const NEW = 'г. Москва, ул. Дорожная, д. 60Ас1';
    private const OLD = '117041, г. Москва, ул. Адмирала Руднева, д. 4, помещ. 26Н/5';

    /**
     * Адрес в верхней плашке берётся из адреса текущего региона
     * (RegionHelper::address → regions.address), с fallback на
     * настройку default_address. Меняем оба источника на новый адрес.
     */
    public function up(): void
    {
        DB::table('regions')->where('slug', 'moscow')
            ->update(['address' => self::NEW, 'updated_at' => now()]);

        // подчистить старый адрес где бы он ни остался
        DB::table('regions')->where('address', 'like', '%Адмирала Руднева%')
            ->update(['address' => self::NEW, 'updated_at' => now()]);

        DB::table('settings')->where('key', 'default_address')->where('value', 'like', '%Адмирала Руднева%')
            ->update(['value' => self::NEW, 'updated_at' => now()]);
    }

    public function down(): void
    {
        DB::table('regions')->where('slug', 'moscow')
            ->update(['address' => self::OLD, 'updated_at' => now()]);
    }
};
