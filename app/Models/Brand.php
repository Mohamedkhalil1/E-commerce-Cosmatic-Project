<?php

namespace App\Models;

use App\Transformers\Brand\BrandTransformer;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $guarded = [];

    public $transformer = BrandTransformer::class;

    public function categories(){
        return $this->belongsToMany(Category::class,'category_brands','brand_id','category_id');
    }

    public function products(){
        return $this->hasMany(Product::class,'brand_id');
    }

    public function division(){
        return $this->belongsTo(Deivison::class,'division_id');
    }

}
