<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function edit(){
        try{
            $user = auth()->user();
            return view("admin.users.edit",compact('user'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'حدث مشكله جرب مره اخرى']);
        }
      
    }

    public function update(UserRequest $request){
        try{
            $user = auth()->user();
            $params = $request->except('_token','password');
            if($request->old_password !== null && $request->password !== null){
                if(Hash::check($request->old_password,$user->password)){
                    $params['password'] = bcrypt($request->password);
                }else{
                    return redirect()->back()->with(['error' => 'كلمه المرور القديمه غير صحيح']);
                }
            }
            $user->update($params);
            return redirect()->back()->with(['success' => 'تم تحديث بياناتك الشخصيه']);
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'حدث مشكله جرب مره اخرى']);
        }
       
    }
}
