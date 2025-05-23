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
        Schema::create('moc_approvals', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('moc_request_id')->nullable();
            $table->foreign('moc_request_id')->references('id')->on('moc_requests');

            // Approval Flow
            $table->enum('approval_type', [
                'initiator', // Fungsi Pengusul
                'examiner', // Fungsi Pemeriksa
                'moc_controller', // MOC Controller
                'final_approval' // Fungsi Persetujuan
            ])->nullable();

            $table->string('approver_name')->nullable();
            $table->string('approver_role')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'revised'])->nullable();
            $table->text('comments')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->string('signature')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moc_approvals');
    }
};
