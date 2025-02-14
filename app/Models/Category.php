<?php

namespace App\Models;
use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Translatable;

    use HasFactory;
    protected $table='categories';
    protected $guarded=[];
    public $timestamps=true;
    //protected $hidden=['translations'];

    protected $translatedAttributes=['name'];


    protected $with=['translations'];
    protected $casts=['is_active'=>'boolean'];

    public function getActive()
    {
        return $this->is_active == 0 ? trans('msg.notactive'): trans('msg.yesactive');
      }

      public function scopeChild($query)
      {
        $query=Category::whereNotNull('parent_id')->select();
        return $query;
      }
      public function scopeParent($query)
      {
        $query=Category::whereNull('parent_id')->select();
        return $query;
      }



}
