<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColletionAccounts extends Model
{
    use HasFactory;
    protected $fillable = [
        'price',
        'url',
        'status',
        'id_assistences'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
