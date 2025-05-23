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
        Schema::create('moc_checklists', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('moc_request_id')->nullable();
            $table->foreign('moc_request_id')->references('id')->on('moc_requests');

            // Checklist 1 (Pre-Implementation)
            $table->json('pre_implementation')->nullable()->comment('F.02 data');
            $table->json('risk_analysis')->nullable();
            $table->json('safety_documents')->nullable();

            // Checklist 2 (Implementation)
            $table->json('implementation_details')->nullable()->comment('F.03 data');
            $table->json('commissioning_data')->nullable();
            $table->json('testing_docs')->nullable();

            // Monitoring
            $table->json('monitoring_schedule')->nullable();
            $table->json('operational_impact')->nullable();

            // Lampiran
            $table->json('attachments')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moc_checklists');
    }
};
