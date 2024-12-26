<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResourceAllocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'farmer_id',
        'resource',
        'date',
        'quantity', 
    ];


    public function farmer()
    {
        return $this->belongsTo(Farmer::class);
    }
}
