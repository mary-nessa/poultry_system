<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HenStock extends Model
{
    use HasFactory;

    protected $fillable = ['branch_id', 'breed', 'quantity', 'age_weeks', 'mortality'];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function isLayingCycleEnding()
{
    $layingCycleWeeks = 72; // Example: Hens lay eggs for around 72 weeks
    return $this->age_weeks >= $layingCycleWeeks;
}

}
