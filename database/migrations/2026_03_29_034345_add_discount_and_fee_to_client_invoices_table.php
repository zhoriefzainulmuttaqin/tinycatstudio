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
            $table->decimal('discount_amount', 15, 2)->default(0)->after('subtotal');
            $table->decimal('additional_fee', 15, 2)->default(0)->after('tax_amount');
            $table->foreignId('client_customer_id')->nullable()->after('client_id')->constrained()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('client_invoices', function (Blueprint $table) {
            $table->dropForeign(['client_customer_id']);
            $table->dropColumn(['discount_amount', 'additional_fee', 'client_customer_id']);
        });
    }
};
