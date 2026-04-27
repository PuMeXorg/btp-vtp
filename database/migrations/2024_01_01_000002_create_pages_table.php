<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('type')->default('page');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->longText('content')->nullable();
            $table->string('excerpt')->nullable();
            $table->string('image')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort')->default(0);
            $table->timestamps();
            $table->foreign('parent_id')->references('id')->on('pages')->nullOnDelete();
        });
    }
    public function down(): void { Schema::dropIfExists('pages'); }
};
