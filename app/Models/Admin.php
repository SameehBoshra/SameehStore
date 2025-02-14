<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
    use HasFactory;
    protected $tables="admins";
    /* protected $fillable=[
        'id',
        'name',
        'email',
        'password'
    ]; */
// this equal
protected $guarded=[];
public $timestamps=true;
}
