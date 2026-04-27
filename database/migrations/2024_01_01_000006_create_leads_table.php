<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('phone');
            $table->string('email')->nullable();
            $table->text('comment')->nullable();
            $table->string('region')->nullable();
            $table->string('source_url')->nullable();
            $table->string('form_type')->default('callback');
            $table->string('status')->default('new');
            $table->unsignedBigInteger('bitrix24_lead_id')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('leads'); }
};
