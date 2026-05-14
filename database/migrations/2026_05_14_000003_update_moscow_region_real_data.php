<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('regions')->where('slug', 'moscow')->update([
            'phone' => '+74951622505',
            'phone_display' => '+7 (495) 162-25-05',
            'email' => 'zakaz@vtp-inz.ru',
            'address' => 'г. Москва, ул. Дорожная, д. 60Ас1',
            'is_active' => true,
            'sort' => 0,
            'updated_at' => now(),
        ]);
    }

    public function down(): void {}
};
