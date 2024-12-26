<?php
namespace App\Models;
use app\Http\Controllers\ProfileController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',  // Add role or any other necessary fields
    ];

    // Optionally, add a guarded array if you want to protect certain fields
    // protected $guarded = ['id', 'created_at', 'updated_at'];
}
