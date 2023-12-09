<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    use HasFactory;
    protected $table = 'email_templates';
    protected $fillable = [
        'slug',
        'name',
        'subject',
        'message',
        'placeholders',
    ];

    protected $casts = [
        'placeholders' => 'array',
    ];

    protected $attributes = [
        'placeholders' => '[]',
    ];


}
