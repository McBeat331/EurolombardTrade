<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use Sluggable;
    use HasFactory;

    protected $table = 'addresses';

    protected $fillable = [
        'country_id',
        'name'
    ];


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['country.name','name']
            ]
        ];
    }

    public function countrytable()
    {
        return $this->morphTo();
    }
}
