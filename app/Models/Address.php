<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use Sluggable;
    use HasFactory;

    public const PAGINATE = 15;

    protected $table = 'addresses';

    protected $fillable = [
        'city_id',
        'name'
    ];


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['city.name','name']
            ]
        ];
    }

    public function city()
    {
        return $this->hasOne(City::class);
    }
}
