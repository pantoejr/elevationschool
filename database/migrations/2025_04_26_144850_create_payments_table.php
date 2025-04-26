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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('student_invoice_id');
            $table->foreign('student_invoice_id')->references('invoice_id')->on('student_invoices')->onDelete('cascade');
            $table->decimal('amount_paid', 10, 2);
            $table->date('payment_date')->default(now());
            $table->enum('currency', ['usd', 'lrd'])->nullable();
            $table->enum('payment_method', ['cash', 'cheque', 'deposit', 'deferred', 'mobile_money','bank_transfer','orange_money'])->default('cash');
            $table->string('payment_reference')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('notes')->nullable();
            $table->string('attachment')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
