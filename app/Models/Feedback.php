<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;


    public const PAGINATE = 20;

    public const STATUS_NOT_VERIFIED = 0;
    public const STATUS_TO_VERIFIED = 1;

    protected $table = 'feedback';

    protected $fillable = ['city_id','service_id', 'name','phone','status'];

    public function service()
    {
        return $this->belongsTo(Service::class,'service_id','id');
    }


    public function city()
    {
        return $this->belongsTo(City::class,'city_id','id');
    }
}
