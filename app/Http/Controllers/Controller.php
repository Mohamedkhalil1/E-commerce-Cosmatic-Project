<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $error_msg= "Something goes wrong , please try again";
    protected $added_msg= "has been added";
    protected $updated_msg = "has been updated";
    protected $deleted_msg = "has been deleted";

    function uploadImage($folder,$image){
        $image->store('/',$folder);
        $filename= $image->hashName();
        $path = 'images/'.$folder.'/'.$filename;
        return $path;
    }
}
