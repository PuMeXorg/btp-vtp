<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $map = [
            'povysitelnye-nasosnye-stantsii' => '/public/images/about/povis1.jpeg',
            'nasosnye-stantsii-pozharotusheniya' => '/public/images/about/pns1.jpg',
            'nasosnye-stantsii-podderzhania-davlenia' => '/public/images/nspd/nspd1.jpg',
        ];

        foreach ($map as $slug => $image) {
            DB::table('pages')->where('slug', $slug)->update([
                'image' => $image,
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void {}
};
