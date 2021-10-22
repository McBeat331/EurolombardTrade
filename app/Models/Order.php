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
    public const STATUS_REJECTED = 2;

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'address_id',
        'currency_from',
        'rate_from',
        'price_from',
        'currency_to',
        'rate_to',
        'price_to',
        'status',
    ];

    public function address()
    {
        return $this->belongsTo(Address::class,'address_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
