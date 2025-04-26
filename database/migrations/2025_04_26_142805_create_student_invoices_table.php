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
        Schema::create('student_invoices', function (Blueprint $table) {
            $table->string('invoice_id')->primary();
            $table->foreignId('student_section_id')->constrained()->onDelete('cascade');
            $table->decimal('amount_paid', 8, 2);
            $table->decimal('balance', 8, 2);
            $table->date('due_date');
            $table->enum('currency', ['USD', 'LRD']);
            $table->boolean('is_completed');
            $table->string('created_by');
            $table->string('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_invoices');
    }
};
