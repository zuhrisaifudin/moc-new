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
        Schema::create('description_changes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('criteria_id')->nullable()->constrained()->nullOnDelete();
            $table->string('description_change_name')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('description_changes');
    }
};
