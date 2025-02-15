<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = ['branch_id', 'category', 'amount', 'date', 'description'];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
