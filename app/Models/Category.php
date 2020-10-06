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

    ///////////////////////////////////////////////////////////////////////////////////////////////

    public function scopeSelection($query){
        return $query->select('id', 'parent_id', 'slug','is_active');
    }

    public function scopeParent($query){
        return $query->whereNull('parent_id');
    }
    public function scopeChild($query){
        return $query->whereNotNull('parent_id');
    }

    public function getActive(){
        //return $this->is_active == 1 ? __('message.fr.active') : 'inactive';
        return $this->is_active == 1 ? 'مغعل' : 'غير مفعل';
    }

    public function _parent(){
        return $this->belongsTo(self::class,'parent_id');
    }

    public function scopeActive($q){
        return $q->where('is_active',1);
    }

}
