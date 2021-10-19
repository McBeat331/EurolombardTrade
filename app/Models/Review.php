<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    public const PAGINATE = 15;
    public const STATUS_NOT_VERIFIED = 0;
    public const STATUS_TO_VERIFIED = 1;
    public const STATUS_REJECTED = 3;

    protected $table = 'reviews';

    protected $fillable = ['user_id','name','description','rating','status'];
}
