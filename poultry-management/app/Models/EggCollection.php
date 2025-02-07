<?php

namespace App\Models; // ✅ Ensure this is correct (not App\Http\Controllers)

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EggCollection extends Model
{
    use HasFactory;

    protected $fillable = ['branch_id', 'date', 'total_collected', 'breakages', 'losses', 'transferred', 'user_id'];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
