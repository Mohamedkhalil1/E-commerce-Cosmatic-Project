<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\SubCategoryRequest;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends Controller
{
    

    public function index(Request $request)
    {
        try{
            if($request->searchValue){
                $categories = Category::whereNotNull('parent_id')->where('title', 'like', '%'.$request->searchValue.'%')
                ->paginate($this->pagination);
            }
            else{
                $categories =  Category::whereNotNull('parent_id')->paginate($this->pagination);
            }
            

            return view('admin.subcategories.index',compact('categories'));
        }catch(\Exception $ex){
            return redirect()->route('admin.subcategories')->with(['error' =>  $this->error_msg]);
        }
        
    }

    
    public function create()
    {
        try{
            $categories = Category::whereNull('parent_id')->get();
            $brands = Brand::all();
            return view('admin.subcategories.create',compact('categories','brands'));  
        }catch(\Exception $ex){
            return redirect()->route('admin.subcategories')->with(['error' => $this->error_msg]);
        }
    }

    public function store(SubCategoryRequest $request)
    {
        try{
            DB::beginTransaction();
            $params = $request->except('_token','brands'); 
            $filePath = $this->uploadImage('categories',$request->image);
            $params['image'] = $filePath;
            $category = Category::create($params);
             // save product with categories relations
         
             $category->brands()->syncWithoutDetaching($request->brands); 
             // end relation
            DB::commit();
            return redirect()->route('admin.subcategories')->with(['success' => 'Category '.$this->added_msg]);
        }catch(\Exception $ex){
            DB::rollback();
            dd($ex);
            return redirect()->route('admin.subcategories')->with(['error' => $this->error_msg]);
        }
     
    }

    public function show($id)
    {
        try{
           
            $category  = Category::whereNotNull('parent_id')->findOrFail($id);
            $products = $category->products()->get();
            return view('admin.subcategories.show',compact('category','products'));
        }catch(\Exception $ex){
            dd($ex);
            return redirect()->route('admin.subcategories')->with(['error' => $this->error_msg]);
        }
    }

    public function edit($id)
    {
        try{
           
            $category  = Category::whereNotNull('parent_id')->findOrFail($id);
            $categories  =Category::whereNull('parent_id')->get();
            $brands_ids = array();
            foreach($category->brands as $brand){
                array_push($brands_ids,$brand->id);
            }
            $brands = Brand::all();
            return view('admin.subcategories.edit',compact('category','categories','brands','brands_ids'));
        }catch(\Exception $ex){
            dd($ex);
            return redirect()->route('admin.subcategories')->with(['error' => $this->error_msg]);
        }
        
    }

    public function update(SubCategoryRequest $request, $id)
    {
        try{
            DB::beginTransaction();
            $params = $request->except('_token','brands');
            $category =  Category::whereNotNull('parent_id')->findOrFail($id);
            $category->brands()->detach();
            $category->brands()->syncWithoutDetaching($request->brands);
            if($request->image !== null){
                 if($category->image !== null){
                    $image = base_path('assets/'.$category->image); 
                    unlink($image);
                }
                $filePath = $this->uploadImage('categories',$request->image);
                $params['image'] = $filePath;
            }
            $category->update($params);
            DB::commit();
            return redirect()->route('admin.subcategories')->with(['success' =>'Category '.$this->updated_msg]);
        }catch(\Exception $ex){
            DB::rollback();
            dd($ex);
            return redirect()->route('admin.subcategories')->with(['error' => $this->error_msg]);
        }  
    }

    public function destroy($id)
    {
        try{
            $category = Category::whereNotNull('parent_id')->findOrFail($id);
             $image = base_path('assets/'.$category->image); 
            unlink($image);
            $category->delete();
            return redirect()->route('admin.subcategories')->with(['success' => 'Category '.$this->deleted_msg ]);
        }catch(\Exception $ex){
            return redirect()->route('admin.subcategories')->with(['error' => $this->error_msg]);
        } 
    }

}
