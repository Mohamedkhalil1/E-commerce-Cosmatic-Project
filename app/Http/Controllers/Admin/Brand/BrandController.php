<?php

namespace App\Http\Controllers\Admin\Brand;

use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        try{
            $brands = Brand::all();
            return view('admin.brands.index',compact('brands'));
        }catch(\Exception $ex){
            return redirect()->route('admin.brands')->with(['error' =>  $this->error_msg]);
        }
        
    }

    
    public function create()
    {
        try{
            return view('admin.brands.create');  
        }catch(\Exception $ex){
            return redirect()->route('admin.brands')->with(['error' => $this->error_msg]);
        }
    }

    public function store(BrandRequest $request)
    {
        try{
            $params = $request->except('_token');
            Brand::create($params);
            return redirect()->route('admin.brands')->with(['success' => 'Brand '.$this->added_msg]);
        }catch(\Exception $ex){
            dd($ex);
            return redirect()->route('admin.brands')->with(['error' => $this->error_msg]);
        }
     
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        try{
           
            $brand  = Brand::findOrFail($id);
            return view('admin.brands.edit',compact('brand'));
        }catch(\Exception $ex){
            dd($ex);
            return redirect()->route('admin.brands')->with(['error' => $this->error_msg]);
        }
        
    }

    public function update(BrandRequest $request, $id)
    {
       
        try{
            $params = $request->except('_token');
           
            Brand::findOrFail($id)->update($params);
            return redirect()->route('admin.brands')->with(['success' =>'Brand '.$this->updated_msg]);
        }catch(\Exception $ex){
            return redirect()->route('admin.brands')->with(['error' => $this->error_msg]);
        }  
    }

    public function destroy($id)
    {
        try{
            $brand = Brand::findOrFail($id);
            $brand->delete();
            return redirect()->route('admin.brands')->with(['success' => 'Brand '.$this->deleted_msg ]);
        }catch(\Exception $ex){
            return redirect()->route('admin.brands')->with(['error' => $this->error_msg]);
        } 
    }
}
