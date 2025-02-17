<?php

namespace App\Models;
use Astrotomic\Translatable\Translatable;
use App\Models\TagTranslation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    use Translatable;
    protected $guarded=[];
    public $timestamps=true;

    protected $translatedAttributes=['name'];
    protected $with=['translations'];



}
