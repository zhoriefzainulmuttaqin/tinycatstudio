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
        Schema::table('client_invoices', function (Blueprint $table) {
            $table->boolean('is_recurring')->default(false)->after('status');
            $table->string('recurring_interval')->nullable()->after('is_recurring'); // weekly, monthly, yearly
            $table->date('next_recurring_date')->nullable()->after('recurring_interval');
            $table->foreignId('parent_invoice_id')->nullable()->after('client_id')->constrained('client_invoices')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('client_invoices', function (Blueprint $table) {
            $table->dropForeign(['parent_invoice_id']);
            $table->dropColumn(['is_recurring', 'recurring_interval', 'next_recurring_date', 'parent_invoice_id']);
        });
    }
};
