<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'message'];

    protected $hidden = ['created_at', 'updated_at'];

    public static $cast = [
        'name' => 'string',
        'email' => 'string',
        'message' => 'string',
    ];

}
