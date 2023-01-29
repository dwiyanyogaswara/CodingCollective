<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'education',
        'birthday',
        'experience',
        'last_position',
        'applied_position',
        'top5_skills',
        'email',
        'phone',
        'resume'
    ];
}
