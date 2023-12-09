<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'slug',
        'is_test',
        'ip_address',
        'name',
        'value'
    ];
    protected $casts = [
        'value' => 'json',
    ];

}
