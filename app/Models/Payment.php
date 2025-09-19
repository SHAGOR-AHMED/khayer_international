<?php

namespace App\Models;

use App\Models\Bank;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
    
}
