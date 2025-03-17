<?php

namespace App\Models;

use App\Http\Controllers\Dashboard\ProductController;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;
    use Translatable, SoftDeletes;
    protected $guarded =[];
    public $timestamps = true;

    protected $translatedAttributes = ['name','description','short_description'];
    protected $with = ['translations'];
    protected $casts = [
        'is_active' => 'boolean',
        'manage_stock' => 'boolean',
        'in_stock' => 'boolean',
    ];
    protected  $date=[
        'special_price_start',
        'special_price_end',
        'start_date',
        'end_date',
        'deleted_at'
    ];


    public function brand()
    {
        return $this->belongsTo(Brand::class)->withDefault();
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class ,'product_categories');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class ,'product_tags');
    }
    public function getActive()
    {
        return $this->is_active  ? trans('msg.yesactive'): trans('msg.notactive');
    }
    public function getIsActiveAttribute($value)
    {
        return $value == 1 ? 'true' : 'false';  // Ensure it correctly returns 1 or 0
    }

    public function options()
    {
        return $this->hasMany(Option::class,'product_id');
    }

    public function scopeActive($q)
    {
        return $q->where('is_active',1);
    }

     public function images()
    {
        return $this->hasMany(ImageProduct::class, 'product_id');

    }

    public function hasStock($quantity)
    {
        return $this->qty >= $quantity;
    }

    public function outOfStock()
    {
        return $this->qty === 0;
    }

    public function inStock()
    {
        return $this->qty >= 1;
    }


public function getTotal($converted = true)
    {
        return $total =  $this->special_price ?? $this -> price;

    }
}
