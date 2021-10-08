<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $timestamps = false;

    protected $table = 'settings';

    protected $fillable = [
        'field',
        'value',
    ];
}
