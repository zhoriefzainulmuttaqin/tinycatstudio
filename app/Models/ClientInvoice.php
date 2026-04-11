<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientInvoice extends Model
{
    protected $fillable = [
        'client_id',
        'client_customer_id',
        'parent_invoice_id',
        'invoice_number',
        'customer_name',
        'customer_email',
        'customer_address',
        'issue_date',
        'due_date',
        'subtotal',
        'discount_amount',
        'tax_rate',
        'tax_amount',
        'additional_fee',
        'total_amount',
        'notes',
        'status',
        'is_recurring',
        'recurring_interval',
        'next_recurring_date',
    ];

    protected function casts(): array
    {
        return [
            'issue_date' => 'date',
            'due_date' => 'date',
            'next_recurring_date' => 'date',
            'is_recurring' => 'boolean',
            'subtotal' => 'decimal:2',
            'discount_amount' => 'decimal:2',
            'tax_rate' => 'decimal:2',
            'tax_amount' => 'decimal:2',
            'additional_fee' => 'decimal:2',
            'total_amount' => 'decimal:2',
        ];
    }

    public static function formatNumber(float|int|string|null $value, int $maxDecimals = 2): string
    {
        $number = round((float) ($value ?? 0), $maxDecimals);
        $formatted = number_format($number, $maxDecimals, ',', '.');

        return str_contains($formatted, ',')
            ? rtrim(rtrim($formatted, '0'), ',')
            : $formatted;
    }

    public static function formatRupiah(float|int|string|null $value): string
    {
        return 'Rp ' . self::formatNumber($value);
    }

    public static function statusOptions(): array
    {
        return [
            'draft' => 'Draf',
            'deposit' => 'Uang Muka',
            'paid' => 'Lunas',
            'overdue' => 'Lewat Jatuh Tempo',
        ];
    }

    public static function recurringIntervalOptions(): array
    {
        return [
            'weekly' => 'Mingguan',
            'monthly' => 'Bulanan',
            'yearly' => 'Tahunan',
        ];
    }

    public static function statusLabel(?string $status): string
    {
        return self::statusOptions()[$status] ?? \Illuminate\Support\Str::headline((string) $status);
    }

    public static function recurringIntervalLabel(?string $interval): string
    {
        return self::recurringIntervalOptions()[$interval] ?? \Illuminate\Support\Str::headline((string) $interval);
    }

    public function getStatusLabelAttribute(): string
    {
        return self::statusLabel($this->status);
    }

    public function getRecurringIntervalLabelAttribute(): string
    {
        return self::recurringIntervalLabel($this->recurring_interval);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function customer()
    {
        return $this->belongsTo(ClientCustomer::class, 'client_customer_id');
    }

    public function items()
    {
        return $this->hasMany(ClientInvoiceItem::class);
    }

    public function recalculateTotals()
    {
        $this->subtotal = $this->items()->sum(\Illuminate\Support\Facades\DB::raw('quantity * unit_price'));
        $afterDiscount = max(0, $this->subtotal - $this->discount_amount);
        $this->tax_amount = $afterDiscount * ($this->tax_rate / 100);
        $this->total_amount = $afterDiscount + $this->tax_amount + $this->additional_fee;
        $this->saveQuietly();
    }
}
