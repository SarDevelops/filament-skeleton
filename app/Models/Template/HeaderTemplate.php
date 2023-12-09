<?php

namespace App\Models\Template;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class HeaderTemplate extends Model
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

    public static function scopeWithSlug($query)
    {
        return $query->where('slug', 'email-header');
    }

    public function index(): Query
    {
        return $this->query()->where('slug', 'email-template');
    }
}
