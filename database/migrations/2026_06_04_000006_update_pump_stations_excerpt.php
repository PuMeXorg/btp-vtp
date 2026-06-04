<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    private const NEW = 'Насосные станции применяются для повышения давления в системах водоснабжения и пожаротушения.';
    private const OLD = 'Повысительные, противопожарные и насосные станции поддержания давления — проектирование и поставка под ключ.';

    public function up(): void
    {
        DB::table('pages')->where('slug', 'nasosnye-stantsii')
            ->update(['excerpt' => self::NEW, 'updated_at' => now()]);
    }

    public function down(): void
    {
        DB::table('pages')->where('slug', 'nasosnye-stantsii')
            ->update(['excerpt' => self::OLD, 'updated_at' => now()]);
    }
};
