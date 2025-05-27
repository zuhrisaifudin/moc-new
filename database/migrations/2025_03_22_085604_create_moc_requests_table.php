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
        Schema::create('moc_requests', function (Blueprint $table) {
            $table->string('id')->primary();
            // Identitas MOC
            $table->string('moc_number')->unique()->nullable();
            $table->string('moc_title')->nullable();
            $table->json('type_of_change')->nullable()->comment('Tipe perubahan: 1 = Instalasi, 2 = Proses, 3 = Regulasi, 4 = Lainnya');
            $table->json('risk_level')->nullable()->comment('Risk level (1=Low, 2=Low to Moderate, 3=Moderate, 4=Moderate to High, 5=High)');
            $table->string('risk_level_document')->nullable();
            $table->date('date')->nullable();
            $table->integer('status')->default(1)->nullable()->comment('1 = Pending, 2 = Submit, 3 = Approved, 4 = Reject');

            // Lokasi dan Area
            $table->string('region_id')->nullable();
            $table->string('region_name')->nullable();
            $table->string('region_code')->nullable();

            $table->string('district_id')->nullable();
            $table->string('district_name')->nullable();
            $table->string('district_code')->nullable();

            $table->string('coordinates')->nullable(); // Untuk GIS mapping

            // Proposers
            $table->string('proposed_by')->nullable();
            $table->string('proposer_function')->nullable();
            $table->json('examiner_team')->nullable();

            // Status dan Tracking
            $table->integer('current_stage')   
                ->default(1)
                ->nullable()
                ->comment('1=Pending, 2=Submission, 3=Review, 4=Checklist1, 5=Checklist2, 6=Approval, 7=Closed');

            $table->boolean('is_temporary')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            // Dokumen Referensi
            $table->longText('change_reason')->nullable();
            $table->longText('changed_parts')->nullable();
            $table->longText('changed_to')->nullable();
            $table->string('reference_document')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index(['moc_number', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moc_requests');
    }
};
