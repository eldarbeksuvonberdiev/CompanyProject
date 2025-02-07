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
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('material_id')->constrained('materials')->cascadeOnDelete();
            $table->tinyInteger('type');
            $table->boolean('status');
            $table->double('quantity');
            $table->double('was');
            $table->double('been');
            $table->unsignedBigInteger('from_id');
            $table->foreignId('to_id')->constrained('warehouses')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
