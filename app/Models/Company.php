<?php

namespace App\Models;

use App\Transformers\Company\CompanyTransformer;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
   protected $guarded = [];
   public $timestamps = false;

   public $transformer = CompanyTransformer::class;

    public function products(){
        return $this->hasMany(Product::class,'company_id');
    }


}
