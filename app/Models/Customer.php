<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Customer extends Model
{
    use HasUuids, 
        \Illuminate\Database\Eloquent\Factories\HasFactory;
        
    protected $fillable = [
        'name', 'email',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

