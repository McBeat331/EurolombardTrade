<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public const PAGINATE = 20;

    public const STATUS_NOT_VERIFIED = 0;
    public const STATUS_TO_VERIFIED = 1;

    protected $table = 'orders';

    protected $fillable = [
        'city_id',
        'isOpt',
        'currency_sale',
        'currency_buy',
        'rate_sale',
        'rate_buy',
        'price_sale',
        'price_buy',
        'status',
        'fio',
        'email',
        'phone',
    ];

    public function city()
    {
        return $this->belongsTo(City::class,'city_id','id');
    }

//    public function user()
//    {
//        return $this->belongsTo(User::class,'user_id','id');
//    }
}
