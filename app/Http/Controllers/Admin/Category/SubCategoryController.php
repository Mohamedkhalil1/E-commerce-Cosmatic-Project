<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\SubCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    

    public function index()
    {
        try{
            $categories = Category::whereNotNull('parent_id')->get();
            return view('admin.subcategories.index',compact('categories'));
        }catch(\Exception $ex){
            return redirect()->route('admin.subcategories')->with(['error' =>  $this->error_msg]);
        }
        
    }

    
    public function create()
    {
        try{
            $categories = Category::whereNull('parent_id')->get();
         
            return view('admin.subcategories.create',compact('categories'));  
        }catch(\Exception $ex){
            return redirect()->route('admin.subcategories')->with(['error' => $this->error_msg]);
        }
    }

    public function store(SubCategoryRequest $request)
    {
        try{
            $params = $request->except('_token');
            Category::create($params);
            return redirect()->route('admin.subcategories')->with(['success' => 'Category '.$this->added_msg]);
        }catch(\Exception $ex){
            dd($ex);
            return redirect()->route('admin.subcategories')->with(['error' => $this->error_msg]);
        }
     
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        try{
           
            $category  = Category::whereNotNull('parent_id')->findOrFail($id);
            $categories  =Category::whereNull('parent_id')->get();
            return view('admin.subcategories.edit',compact('category','categories'));
        }catch(\Exception $ex){
            dd($ex);
            return redirect()->route('admin.subcategories')->with(['error' => $this->error_msg]);
        }
        
    }

    public function update(SubCategoryRequest $request, $id)
    {
        try{
            $params = $request->except('_token');
            Category::whereNotNull('parent_id')->findOrFail($id)->update($params);
            return redirect()->route('admin.subcategories')->with(['success' =>'Category '.$this->updated_msg]);
        }catch(\Exception $ex){
            return redirect()->route('admin.subcategories')->with(['error' => $this->error_msg]);
        }  
    }

    public function destroy($id)
    {
        try{
            $category = Category::whereNotNull('parent_id')->findOrFail($id);
            $category->delete();
            return redirect()->route('admin.subcategories')->with(['success' => 'Category '.$this->deleted_msg ]);
        }catch(\Exception $ex){
            return redirect()->route('admin.subcategories')->with(['error' => $this->error_msg]);
        } 
    }

}
