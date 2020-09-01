<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Translatable;

    protected $with = ['translations'];

    protected $translatedAttributes = ['name'];

    protected $fillable = ['id', 'parent_id', 'slug','is_active'];

    //no need everytime it returns translation unless i ask for it, as peformence issue
    protected $hidden = ['translations'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
