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
    public const STATUS_REJECTED = 2;

    protected $table = 'reviews';

    protected $fillable = ['user_id','name','description','rating','status'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
