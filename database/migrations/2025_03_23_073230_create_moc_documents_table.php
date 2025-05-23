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
        Schema::create('moc_documents', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('moc_request_id')->nullable();
            $table->foreign('moc_request_id')->references('id')->on('moc_requests');

            $table->enum('document_type', [
                'request_form',
                'checklist1',
                'checklist2',
                'risk_analysis',
                'technical_drawing',
                'commission_report'
            ])->nullable();

            $table->string('file_path')->nullable();
            $table->string('original_name')->nullable();
            $table->string('version')->default('1.0')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moc_documents');
    }
};
