<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_type_certificates',
        'id_logistics',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
