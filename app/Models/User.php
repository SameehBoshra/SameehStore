<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function VerfiyCodes()
    {
        return $this->hasMany(UsersVerficationCodes::class ,'user_id');
    }

    public function wishlist()
    {
        return $this->belongsToMany(Product::class, 'wish_lists');
    }

    public function wishlistHas($productId)
    {
        return $this->wishlist()->where('product_id' ,$productId)->exists();
    }



    public function cart()
    {
        return $this->belongsToMany(Product::class, 'carts');
    }

    public function carttHas($productId)
    {
        return self::cart()->where('product_id' ,$productId)->exists();
    }
}
