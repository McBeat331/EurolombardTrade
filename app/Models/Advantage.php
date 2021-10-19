<?php

namespace App\Models;

use App\Job\ImageJob;
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

    protected $fillable = ['title', 'description','meta_title', 'meta_description','slug','image','sort'];

    public $translatable = ['title', 'description','meta_title', 'meta_description','slug'];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function getImageLinkAttribute()
    {
        return ImageJob::getImage($this->image,$this->table);
    }
}
