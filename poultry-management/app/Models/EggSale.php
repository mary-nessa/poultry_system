<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EggSale extends Model
{
    use HasFactory;

    protected $fillable = ['branch_id', 'user_id', 'date', 'sale_type', 'quantity', 'price_per_unit', 'total_price'];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
