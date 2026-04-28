<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('homepage_blocks', function (Blueprint $table) {
            $table->id();

            $table->string('type')->default('hero');
            $table->string('title')->nullable();
            $table->text('subtitle')->nullable();
            $table->longText('content')->nullable();

            $table->string('image')->nullable();

            $table->string('button_text')->nullable();
            $table->string('button_url')->nullable();

            $table->json('settings')->nullable();

            $table->boolean('is_active')->default(true);
            $table->integer('sort')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('homepage_blocks');
    }
};
