<?php

namespace App\Models;

use App\Models\Entry;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agent extends Model
{
    use HasFactory;

    public function entries()
    {
        return $this->hasMany(Entry::class);
    }


}
