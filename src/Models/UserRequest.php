<?php

namespace Pandoux\LaravelUserRequestLogger\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRequest extends Model
{
    use HasFactory;

    protected $table = 'user_request';

    protected $fillable = [
        'url',
        'route',
        'method',
        'content',
        'ip',
        'user_agent',
        'is_ajax',
        'is_https',
    ];

    protected $casts = [
        'content' => 'array'
    ];
}
