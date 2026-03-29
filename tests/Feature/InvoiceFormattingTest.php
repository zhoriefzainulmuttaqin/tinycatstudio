<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\ClientInvoice;
use App\Models\ClientInvoiceItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InvoiceFormattingTest extends TestCase
{
    use RefreshDatabase;

    public function test_invoice_formatter_hides_trailing_zero_decimals(): void
    {
        $this->assertSame('Rp 1.450.000', ClientInvoice::formatRupiah(1450000));
        $this->assertSame('2', ClientInvoice::formatNumber(2));
        $this->assertSame('11', ClientInvoice::formatNumber(11));
    }

    public function test_invoice_template_does_not_render_trailing_comma_zero_zero(): void
    {
        $client = Client::create([
            'name' => 'Tiny Cat Studio',
            'email' => 'client@example.com',
            'password' => 'password123',
            'is_active' => true,
        ]);

        $invoice = ClientInvoice::create([
            'client_id' => $client->id,
            'invoice_number' => 'INV-001',
            'customer_name' => 'Budi',
            'issue_date' => now()->toDateString(),
            'due_date' => now()->addDays(7)->toDateString(),
            'subtotal' => 2900000,
            'discount_amount' => 100000,
            'tax_rate' => 11,
            'tax_amount' => 308000,
            'total_amount' => 3108000,
            'status' => 'draft',
        ]);

        ClientInvoiceItem::create([
            'client_invoice_id' => $invoice->id,
            'description' => 'Website Development',
            'quantity' => 2,
            'unit_price' => 1450000,
        ]);

        $invoice->load(['client', 'items']);

        $html = view('invoices.template', compact('invoice'))->render();

        $this->assertStringContainsString('Rp 1.450.000', $html);
        $this->assertStringContainsString('Rp 2.900.000', $html);
        $this->assertStringContainsString('-Rp 100.000', $html);
        $this->assertStringContainsString('Tax (11%)', $html);
        $this->assertDoesNotMatchRegularExpression('/Rp\s[\d\.]+,00/', $html);
        $this->assertStringNotContainsString('2,00', $html);
        $this->assertStringNotContainsString('11,00%', $html);
    }
}
