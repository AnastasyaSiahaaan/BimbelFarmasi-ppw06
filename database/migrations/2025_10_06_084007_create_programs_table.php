<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('type'); // 'ukom', 'cpns', 'joki'
            $table->text('description');
            $table->text('features')->nullable(); // JSON
            $table->decimal('price', 12, 2);
            $table->integer('duration_months')->nullable(); // Nullable for project-based services
            $table->integer('total_sessions')->nullable(); // Nullable for project-based services
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
