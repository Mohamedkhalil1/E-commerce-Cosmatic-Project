<?php

namespace App\Http\Controllers\Admin\Shipping;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shipping\ShippingRequest;
use App\Models\Shipping;

class ShippingController extends Controller
{
    public function index()
    {
        try{
            $shippings = Shipping::paginate($this->pagination);
            return view('admin.shippings.index',compact('shippings'));
        }catch(\Exception $ex){
            return redirect()->route('admin.shippings')->with(['error' =>  $this->error_msg]);
        }
        
    }

    
    public function create()
    {
        try{
            return view('admin.shippings.create');  
        }catch(\Exception $ex){
            return redirect()->route('admin.shippings')->with(['error' => $this->error_msg]);
        }
    }

    public function store(ShippingRequest $request)
    {
        try{
            $params = $request->except('_token');
            Shipping::create($params);
            return redirect()->route('admin.shippings')->with(['success' => 'Shipping '.$this->added_msg]);
        }catch(\Exception $ex){
            dd($ex);
            return redirect()->route('admin.shippings')->with(['error' => $this->error_msg]);
        }
     
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        try{
           
            $shipping  = Shipping::findOrFail($id);
            return view('admin.shippings.edit',compact('shipping'));
        }catch(\Exception $ex){
            dd($ex);
            return redirect()->route('admin.shippings')->with(['error' => $this->error_msg]);
        }
        
    }

    public function update(ShippingRequest $request, $id)
    {
       
        try{
            $params = $request->except('_token');
           
            Shipping::findOrFail($id)->update($params);
            return redirect()->route('admin.shippings')->with(['success' =>'Shipping '.$this->updated_msg]);
        }catch(\Exception $ex){
            return redirect()->route('admin.shippings')->with(['error' => $this->error_msg]);
        }  
    }

    public function destroy($id)
    {
        try{
            $code = Shipping::findOrFail($id);
            $code->delete();
            return redirect()->route('admin.shippings')->with(['success' => 'Shipping '.$this->deleted_msg ]);
        }catch(\Exception $ex){
            return redirect()->route('admin.shippings')->with(['error' => $this->error_msg]);
        } 
    }
}
