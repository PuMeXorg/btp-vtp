<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Slugs дочерних страниц каталога — не меняются между средами
        $childSlugs = [
            'vvodno-raspredelitelnye-ustroystva',
            'shkafy-avtomatiki-ventilyatsii',
            'shkafy-upravleniya-nasosami',
            'schity-upravleniya-chastotnymi-elektroprivodami',
            'shkafy-upravleniya-drenazhnymi-nasosami',
            'stantsiya-upravleniya-nasosami-su-pp',
            'avtomaticheskie-stantsii-upravleniya-nasosami',
            'shkaf-upravleniya-elektrozadvizhkoy',
            'shkafy-avr',
            'raspredelitelnye-shkafy',
            'shkaf-upravleniya-pozharotusheniem',
            'avtomatizatsiya-kotelnykh',
            'stantsii-upravleniya-su-che',
            'schity-avtomaticheskogo-pereklyucheniya-na-rezerv',
        ];

        // Ищем родителя — сначала по новому slug, потом по старому
        $parent = DB::table('pages')->where('slug', 'proizvodstvo-elektroshchitovogo-oborudovaniya')->first()
            ?? DB::table('pages')->where('slug', 'shkafy-avtomatiki')->first();

        if (! $parent) {
            return;
        }

        $parentId = $parent->id;

        // Родитель — type=service
        DB::table('pages')->where('id', $parentId)->update([
            'type'       => 'service',
            'updated_at' => now(),
        ]);

        // Привязываем всех детей к правильному родителю
        DB::table('pages')->whereIn('slug', $childSlugs)->update([
            'parent_id'  => $parentId,
            'type'       => 'service',
            'is_active'  => true,
            'updated_at' => now(),
        ]);
    }

    public function down(): void {}
};
