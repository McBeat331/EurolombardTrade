<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasSlug;
    use HasFactory;

    public const PAGINATE = 15;

    protected $table = 'addresses';

    protected $fillable = [
        'city_id',
        'name'
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('city.name')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

//    public function sluggable(): array
//    {
//        return [
//            'slug' => [
//                'source' => ['city.name','name']
//            ]
//        ];
//    }

    public function city()
    {
        return $this->hasOne(City::class);
    }
}
