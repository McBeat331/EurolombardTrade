<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Advantage extends Model
{
    use HasFactory,HasTranslations,HasTranslatableSlug;

    public const PAGINATE = 15;

    protected $table = 'advantages';

    protected $fillable = ['title', 'description','slug','image'];

    public $translatable = ['title', 'description','slug'];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
}
