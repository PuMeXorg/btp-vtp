<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $exists = DB::table('regions')->where('slug', 'moscow')->exists();
        if ($exists) {
            DB::table('regions')->where('slug', 'moscow')->update([
                'is_active' => true,
                'sort' => 0,
                'updated_at' => now(),
            ]);
            return;
        }

        DB::table('regions')->insert([
            'slug' => 'moscow',
            'name' => 'Москва',
            'phone' => '+74950000000',
            'phone_display' => '+7 (495) 000-00-00',
            'email' => 'info@vtp-inj.ru',
            'address' => '123376, Москва, ул. Красная Пресня, д. 28, эт. 3/2',
            'working_hours' => 'Пн-пт: 09:00–18:00',
            'is_active' => true,
            'sort' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void {}
};
