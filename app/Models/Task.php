<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    protected $filltable = [
        'name',
        'is_completed',
    ];
    protected $fillable = [
        'name',
    ];
}
