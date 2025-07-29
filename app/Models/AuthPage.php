<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'section',
        'image',
        'parent_id',
    ];
}
