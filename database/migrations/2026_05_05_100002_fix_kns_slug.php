<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Update slug for the renamed КНС page
        DB::table('pages')
            ->where('slug', 'kanalizatsionnye-nasosnye-stantsii')
            ->update(['slug' => 'nasosnye-stantsii-podderzhania-davlenia']);

        // Also handle any variant spellings just in case
        DB::table('pages')
            ->where('title', 'like', '%Насосные станции поддержания давления%')
            ->whereNotIn('slug', ['nasosnye-stantsii-podderzhania-davlenia', 'nasosnye-stantsii-pozharotusheniya'])
            ->update(['slug' => 'nasosnye-stantsii-podderzhania-davlenia']);
    }

    public function down(): void
    {
        DB::table('pages')
            ->where('slug', 'nasosnye-stantsii-podderzhania-davlenia')
            ->update(['slug' => 'kanalizatsionnye-nasosnye-stantsii']);
    }
};
