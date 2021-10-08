<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    public const PAGINATE = 15;

    protected $table = 'countries';

    protected $fillable = [
        'name'
    ];

    public function addresses()
    {
        return $this->hasMany(Address::class, 'country_id');
    }
}
