<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('settings')->updateOrInsert(
            ['key' => 'default_email'],
            [
                'value' => 'region@vtp-inz.ru',
                'type' => 'string',
                'label' => 'Email (общий)',
                'group' => 'contacts',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('regions')->update([
            'email' => 'region@vtp-inz.ru',
            'updated_at' => now(),
        ]);

        $oldEmails = [
            'zakaz@teplovoy-punkt.ru',
            'zakaz@vtp-inz.ru',
            'info@btp-vtp.ru',
            'info@company.ru',
            'kazan@company.ru',
            'samara@company.ru',
            'rostov@company.ru',
            'spb@company.ru',
        ];

        foreach ($oldEmails as $oldEmail) {
            DB::table('pages')
                ->where('content', 'like', '%'.$oldEmail.'%')
                ->update([
                    'content' => DB::raw("REPLACE(content, '".str_replace("'", "''", $oldEmail)."', 'region@vtp-inz.ru')"),
                    'updated_at' => now(),
                ]);
        }

        Cache::flush();
    }

    public function down(): void {}
};
