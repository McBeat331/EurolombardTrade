<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    public const PAGINATE = 15;

    protected $table = 'reviews';

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'rating',
    ];
}
