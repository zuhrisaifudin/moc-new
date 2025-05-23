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
        Schema::create('moc_histories', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('moc_request_id')->nullable();
            $table->foreign('moc_request_id')->references('id')->on('moc_requests');

            $table->enum('activity_type', [
                'submission',
                'review',
                'approval',
                'revision',
                'implementation',
                'closure'
            ])->nullable();

            $table->text('description')->nullable();
            $table->string('changed_by')->nullable();
            $table->json('before_state')->nullable();
            $table->json('after_state')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moc_histories');
    }
};
