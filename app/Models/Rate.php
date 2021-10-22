<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    protected $table = 'rates';

    protected $fillable = ['city_id','currency','buy','sale','api_id'];


    public function city()
    {
        return $this->belongsTo(City::class,'city_id','id');
    }
}
