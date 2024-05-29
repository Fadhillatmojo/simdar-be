<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HealthFacility extends Model
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone_number',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
}

