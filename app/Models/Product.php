<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Product extends Model
{
    use HasUuids;

    protected $fillable = [
        'name', 'price', 'customer_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
