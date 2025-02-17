<?php

namespace App\Models;
use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    use Translatable;
    protected $table='brands';
    protected $guarded=[];
    public $timestamps=true;

    protected $translatedAttributes=['name'];


    protected $with=['translations'];
    protected $casts=['is_active'=>'boolean'];

    public function getActive()
    {
        return $this->is_active == 0 ? trans('msg.notactive'): trans('msg.yesactive');
      }

      public function getPhoto($value)
      {
        return ($value!==Null)?asset('assests/images/brands/'.$value):"";

      }

      public function scopeActive($query)
      {
          return $query->where('is_active',1);

      }

}
