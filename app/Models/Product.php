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
    protected $guarded = [];
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
        return $this->belongsToMany(ProductCategory::class ,'product_categories');
    }
    public function tag()
    {
        return $this->belongsToMany(ProductTag::class ,'product_tags');
    }

}
