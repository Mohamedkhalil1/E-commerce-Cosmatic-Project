<?php

namespace App\Models;

use App\Transformers\User\ContactUsTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactUs extends Model
{
    public $transformer = ContactUsTransformer::class;

    protected $guarded = [];

    public function user(){
        return BelongsTo(User::class,'user_id');
    }

}
