<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientCustomer extends Model
{
    protected $fillable = [
        'client_id',
        'name',
        'email',
        'phone',
        'address',
        'notes',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
