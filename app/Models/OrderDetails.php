<?php

namespace App\Models;

use App\Transformers\Order\OrderDetailsTransformer;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    protected $guarded = [];
    public $transformer = OrderDetailsTransformer::class;

    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }

    public function product(){
        return $this->belongsTo(product::class,'product_id');
    }
    
}
