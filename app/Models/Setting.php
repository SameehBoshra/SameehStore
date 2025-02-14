<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use Translatable;
    use HasFactory;
    protected $table='settings';
    protected $guarded=[];

    public $timestamps=true;
    protected $translatedAttributes=['value'];


    protected $with=['translations'];
    protected $casts=['is_translatable'=>'boolean'];

    public static function setMany($settings) {
        foreach($settings as $key=>$value)
        {
            self::set($key,$value);
        }


    }

    public static function set($key , $value) {
        if($key==='translatable')
        {
            return static::setTranslatableSetttings($value);
        }
        if(is_array($value))
        {
            $value=json_encode($value);
        }
        static::UpdateOrCreate(['key'=>$key ], ['plain_value'=>$value]);

    }

    public static function setTranslatableSetttings($settings=[])
    {
        foreach($settings as $key=>$value)
        {
            static::UpdateOrCreate(['key'=>$key]
        ,[
            'is_translatable'=>true,
            'value'=>$value,
        ]);

        }
    }


}
