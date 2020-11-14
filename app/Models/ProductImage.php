<?php

namespace App\Models;

use App\Transformers\Product\ProductImageTransformer;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $guarded = [];
    public $transformer = ProductImageTransformer::class;
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
