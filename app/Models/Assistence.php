<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assistence extends Model
{
    use HasFactory;
    protected $fillable = [
        'hour',
        'status',
        'id_events',
        'id_logistics'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
