<?php

namespace App\Models;

use App\Transformers\Order\OrderTransformer;
use Illuminate\Database\Eloquent\Model;
use App\User;
class Order extends Model
{
    protected $guarded = [];

    public $transformer = OrderTransformer::class;

    
    public function orders(){
        return $this->hasMany(Order::class,'user_id');
    }
    public function products(){
        return $this->belongsToMany(Product::class,'order_details','order_id','product_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function details(){
        return $this->hasMany(OrderDetails::class,'order_id');
    }
}
