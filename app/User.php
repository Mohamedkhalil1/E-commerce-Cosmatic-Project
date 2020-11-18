<?php

namespace App;

use App\Models\Card;
use App\Models\ContactUs;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orders(){
        return $this->hasMany(Order::class,'user_id');
    }

    public function card(){
        return $this->hasOne(Card::class,'user_id');
    }

  
    
    public function favourites(){
        return $this->belongsToMany(Product::class,'favourites','user_id','product_id');
    }

  
    public function userAddress(){
        return $this->hasOne(userAddress::class,'user_id');
    }

    public function contact_us(){
        return $this->hasMany(ContactUs::class,'user_id');
    }


}
