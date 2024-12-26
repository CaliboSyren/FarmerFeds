<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Farmer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'phone_number',
        'gmail_account',
        'land_size',
        'date',
    ];

    public function resourceAllocations(): HasMany
    {
        return $this->hasMany(ResourceAllocation::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($farmer) {
            // Automatically create a resource allocation for the new farmer
            ResourceAllocation::create([
                'farmer_id' => $farmer->id,
                'resource' => 'Default Resource', // You can set a default resource or leave it empty
                'date' => now(), // Set the current date or any other logic
            ]);
        });
    }
}
