<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date',
        'address',
        'start',
        'end',
        'quotas',
        'description',
        'id_type_clothings',
        'id_users'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
