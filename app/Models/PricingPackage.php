<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PricingPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'name',
        'price',
        'description',
        'is_popular',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'is_popular' => 'boolean',
        ];
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function features(): HasMany
    {
        return $this->hasMany(PricingFeature::class, 'package_id')
            ->orderBy('sort_order')
            ->orderBy('id');
    }
}
