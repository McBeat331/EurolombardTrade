<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Address extends Model
{
    use HasFactory,HasTranslations, HasTranslatableSlug;

    public const PAGINATE = 15;

    protected $table = 'addresses';

    protected $fillable = ['city_id','name','time_work','phones','round_the_clock','published','lat','lng','slug'];

    public $translatable = ['name', 'slug'];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['city.name', 'name'])
            ->saveSlugsTo('slug');
    }

    public function city()
    {
        return $this->belongsTo(City::class,'city_id','id');
    }
}
