<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersVerficationCodes extends Model
{
    use HasFactory;
    protected $guarded=[];
    public $timestamps=true;

    public function Users()
    {
        return $this->belongsTo(User::class ,'user_id');
    }
}
