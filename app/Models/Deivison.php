<?php

namespace App\Models;

use App\Transformers\Devision\DevisionTransformer;
use Illuminate\Database\Eloquent\Model;

class Deivison extends Model
{
    protected $guarded = [];

    public $transformer = DevisionTransformer::class;

    public function brands(){
        return $this->hasMany(Brand::class,'division_id');
    }
}
