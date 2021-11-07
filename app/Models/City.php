<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class City extends Model
{
    use HasFactory,HasTranslations;

    public const PAGINATE = 15;

    protected $table = 'cities';

    protected $fillable = ['name','api_id','domain'];

    public $translatable = ['name'];



    public function addresses()
    {
        return $this->hasMany(Address::class, 'city_id','id');
    }

    public function addressFirst()
    {
        return $this->hasOne(Address::class, 'city_id','id');
    }

    public function rates()
    {
        return $this->hasMany(Rate::class, 'city_id','id');
    }
}
