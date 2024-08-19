<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logistic extends Model
{
    use HasFactory;
    protected $fillable = [
        'runt',
        'celular',
        'description',
        'id_users'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
