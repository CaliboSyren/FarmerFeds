<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRegistration extends Model
{
    use HasFactory;

    // Specify the fields that are mass assignable
    protected $fillable = [
        'name',
        'location',
        'phone_number',
        'gmail_account',
        'land_size',
        'date_of_registration',
    ];
}
