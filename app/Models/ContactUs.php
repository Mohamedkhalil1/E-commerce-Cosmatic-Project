<?php

namespace App\Models;

use App\Transformers\User\ContactUsTransformer;
use App\User;
use Illuminate\Database\Eloquent\Model;


class ContactUs extends Model
{
    public $transformer = ContactUsTransformer::class;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

}
