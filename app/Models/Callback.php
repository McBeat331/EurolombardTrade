<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Callback extends Model
{
    use HasFactory,Notifiable;

    public const PAGINATE = 20;

    public const STATUS_NOT_VERIFIED = 0;
    public const STATUS_TO_VERIFIED = 1;

    protected $table = 'callback';

    protected $fillable = ['city_id','name','phone','status'];


    public function city()
    {
        return $this->belongsTo(City::class,'city_id','id');
    }
}
