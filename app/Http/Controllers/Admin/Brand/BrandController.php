<?php

namespace App\Http\Controllers\Admin\Brand;

use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\BrandRequest;
use App\Models\Brand;
use App\Models\Deivison;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        try{
            if($request->searchValue){
                $brands = Brand::where('title', 'like', '%'.$request->searchValue.'%')
                ->paginate($this->pagination);
            }
            else{
                $brands = Brand::paginate($this->pagination); 
            }
           
            return view('admin.brands.index',compact('brands'));
        }catch(\Exception $ex){
            return redirect()->route('admin.brands')->with(['error' =>  $this->error_msg]);
        }
        
    }

    
    public function create()
    {
        try{
            $divisions = Deivison::all();
            return view('admin.brands.create',compact('divisions'));  
        }catch(\Exception $ex){
            return redirect()->route('admin.brands')->with(['error' => $this->error_msg]);
        }
    }

    public function store(BrandRequest $request)
    {
        try{
            $params = $request->except('_token');
            $filePath = $this->uploadImage('brands',$request->image);
            $params['image'] = $filePath;
            Brand::create($params);
            return redirect()->route('admin.brands')->with(['success' => 'Brand '.$this->added_msg]);
        }catch(\Exception $ex){
            dd($ex);
            return redirect()->route('admin.brands')->with(['error' => $this->error_msg]);
        }
    }

    public function show($id)
    {
         try{
            $brand  = Brand::findOrFail($id);
            $categories = $brand->categories()->whereNotNull('parent_id')->get();
            $products= $brand->products()->get();
            return view('admin.brands.show',compact('brand','categories','products'));
        }catch(\Exception $ex){
            dd($ex);
            return redirect()->route('admin.brands')->with(['error' => $this->error_msg]);
        }
    }

    public function edit($id)
    {
        try{
           
            $brand  = Brand::findOrFail($id);
            $divisions = Deivison::all();
            return view('admin.brands.edit',compact('brand','divisions'));
        }catch(\Exception $ex){
            dd($ex);
            return redirect()->route('admin.brands')->with(['error' => $this->error_msg]);
        }
        
    }

    public function update(BrandRequest $request, $id)
    {
       
        try{
            $params = $request->except('_token');
           $brand = Brand::findOrFail($id);
            if($request->image !== null){
                if($brand->image !== null){
                    $image = base_path('assets/'.$brand->image); 
                    unlink($image);
                }
                $filePath = $this->uploadImage('brands',$request->image);
                $params['image'] = $filePath;
               
            }
            $brand->update($params);
            return redirect()->route('admin.brands')->with(['success' =>'Brand '.$this->updated_msg]);
        }catch(\Exception $ex){
            return redirect()->route('admin.brands')->with(['error' => $this->error_msg]);
        }  
    }

    public function destroy($id)
    {
        try{
            $brand = Brand::findOrFail($id);
            $image = base_path('assets/'.$brand->image); 
            unlink($image);
            $brand->delete();
            return redirect()->route('admin.brands')->with(['success' => 'Brand '.$this->deleted_msg ]);
        }catch(\Exception $ex){
            return redirect()->route('admin.brands')->with(['error' => $this->error_msg]);
        } 
    }
}
