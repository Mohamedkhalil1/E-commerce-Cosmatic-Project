<?php

namespace App\Http\Controllers\Admin\Ad;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ad\AdRequest;
use App\Models\Ad;
use Illuminate\Http\Request;

class AdController extends Controller
{
    public function index()
    {
        try{
            
            $ads = Ad::paginate($this->pagination);
            return view('admin.ads.index',compact('ads'));
        }catch(\Exception $ex){
            return redirect()->route('admin.ads')->with(['error' =>  $this->error_msg]);
        }
        
    }

    
    public function create()
    {
        try{
           
            return view('admin.ads.create');  
        }catch(\Exception $ex){
            return redirect()->route('admin.ads')->with(['error' => $this->error_msg]);
        }
    }

    public function store(AdRequest $request)
    {
        try{
            $params = $request->except('_token');
            $filePath = $this->uploadImage('offers',$request->image);
            $params['image'] = $filePath;
            Ad::create($params);
            return redirect()->route('admin.ads')->with(['success' => 'Ad '.$this->added_msg]);
        }catch(\Exception $ex){
            
            dd($ex);
            return redirect()->route('admin.ads')->with(['error' => $this->error_msg]);
        }
     
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        try{
           
            $ad  = Ad::findOrFail($id);
            return view('admin.ads.edit',compact('ad'));
        }catch(\Exception $ex){
            dd($ex);
            return redirect()->route('admin.ads')->with(['error' => $this->error_msg]);
        }
        
    }

    public function update(AdRequest $request, $id)
    {
        try{
            $ad = Ad::findOrFail($id);
            $params = $request->except('_token');
            if($request->image !== null){
                $filePath = $this->uploadImage('offers',$request->image);
                $params['image'] = $filePath;
                $image = base_path('assets/'.$ad->image); 
                unlink($image);
            }
            $ad->update($params);
            return redirect()->route('admin.ads')->with(['success' =>'Ad '.$this->updated_msg]);
        }catch(\Exception $ex){
            dd($ex);
            return redirect()->route('admin.ads')->with(['error' => $this->error_msg]);
        }  
    }

    public function destroy($id)
    {
        try{
            $ad = Ad::findOrFail($id);
            
           
            $image = base_path('assets/'.$ad->image); 
            unlink($image);
            $ad->delete();

            return redirect()->route('admin.ads')->with(['success' => 'Ad '.$this->deleted_msg ]);
        }catch(\Exception $ex){
            return redirect()->route('admin.ads')->with(['error' => $this->error_msg]);
        } 
    }
}
