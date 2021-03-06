<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Review extends Model
{
    use HasFactory,Notifiable;

    public const PAGINATE = 20;

    public const STATUS_NOT_VERIFIED = 0;
    public const STATUS_TO_VERIFIED = 1;

    protected $table = 'reviews';

    protected $fillable = ['city','name','description','rating','status'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
