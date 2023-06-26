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
        Schema::create('humans', function (Blueprint $table) {
            $table->id();
            $table->decimal('health_status');
            $table->integer('physical_fitness');
            $table->integer('resource_consumption');
            $table->decimal('action_decision');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('humans');
    }
};