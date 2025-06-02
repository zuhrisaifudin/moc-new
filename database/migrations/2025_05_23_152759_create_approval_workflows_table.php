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
        Schema::create('approval_workflows', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('moc_request_id');
            $table->foreign('moc_request_id')
                ->references('id')
                ->on('moc_requests')
                ->onDelete('cascade');

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('role')->nullable()->comment('1 = Fungsi Pengusul, 2 = Fungsi Pemeriksa, 3 = MOC Controller, 4 = Fungsi Persetujuan');
            $table->tinyInteger('stage')->nullable()->comment('Tahapan approval (1,2,3...)');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('note')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
            $table->timestamps();
         });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approval_workflows');
    }
};
