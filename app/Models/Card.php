<?php
namespace App\Models;

use App\Transformers\Card\CardTransformer;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $guarded = [];

    public $transformer = CardTransformer::class;

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function products(){
        return $this->belongsToMany(Product::class,'card_of_products','card_id','product_id');
    }
}
