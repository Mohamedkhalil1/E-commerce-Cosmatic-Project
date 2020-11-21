<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index()
    {
        try{
            $contacts = ContactUs::paginate($this->pagination);
            return view('admin.contacts.index',compact('contacts'));
        }catch(\Exception $ex){
            return redirect()->route('admin.contacts')->with(['error' =>  $this->error_msg]);
        }
        
    }
}
