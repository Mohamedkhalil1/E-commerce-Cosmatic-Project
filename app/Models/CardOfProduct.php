<?php

namespace App\Models;

use App\Transformers\Card\CardDetailsTransformer;
use Illuminate\Database\Eloquent\Model;

class CardOfProduct extends Model
{
    protected $guarded = [];
   

    public $transformer = CardDetailsTransformer::class;
}
