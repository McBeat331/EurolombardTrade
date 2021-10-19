<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class City extends Model
{
    use HasFactory,HasTranslations,HasTranslatableSlug;

    public const PAGINATE = 15;

    protected $table = 'cities';

    protected $fillable = ['name'];

    public $translatable = ['name','slug'];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function addresses()
    {
        return $this->hasMany(Address::class, 'city_id');
    }
}
