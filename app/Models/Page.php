<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{
    use HasFactory,HasTranslations;

    public const PAGINATE = 15;

    protected $table = 'pages';

    protected $fillable = ['title','description','meta_title','meta_description','slug'];

    public $translatable = ['title','description','meta_title','meta_description'];

}
