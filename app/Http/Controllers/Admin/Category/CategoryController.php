<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        try{
            if($request->searchValue){
                $categories = Category::whereNull('parent_id')->where('title', 'like', '%'.$request->searchValue.'%')
                ->paginate($this->pagination);
            }
            else{
                $categories = Category::whereNull('parent_id')->paginate($this->pagination);
            }

            return view('admin.categories.index',compact('categories'));
        }catch(\Exception $ex){
            return redirect()->route('admin.categories')->with(['error' =>  $this->error_msg]);
        }
        
    }

    
    public function create()
    {
        try{
           
            return view('admin.categories.create');  
        }catch(\Exception $ex){
            return redirect()->route('admin.categories')->with(['error' => $this->error_msg]);
        }
    }

    public function store(CategoryRequest $request)
    {
        try{
            $params = $request->except('_token');
            $filePath = $this->uploadImage('categories',$request->image);
            $params['image'] = $filePath;
            Category::create($params);
            return redirect()->route('admin.categories')->with(['success' => 'Category '.$this->added_msg]);
        }catch(\Exception $ex){
            dd($ex);
            return redirect()->route('admin.categories')->with(['error' => $this->error_msg]);
        }
     
    }

    public function show($id)
    {
        try{
            $category  = Category::whereNull('parent_id')->findOrFail($id);
            $categories = $category->categories()->whereNotNull('parent_id')->get();
            $products= $category->products()->get();
            return view('admin.categories.show',compact('category','categories','products'));
        }catch(\Exception $ex){
            dd($ex);
            return redirect()->route('admin.categories')->with(['error' => $this->error_msg]);
        }
    }

    public function edit($id)
    {
        try{
           
            $category  = Category::whereNull('parent_id')->findOrFail($id);
            return view('admin.categories.edit',compact('category'));
        }catch(\Exception $ex){
            dd($ex);
            return redirect()->route('admin.categories')->with(['error' => $this->error_msg]);
        }
        
    }

    public function update(CategoryRequest $request, $id)
    {
        try{
            $category=Category::whereNull('parent_id')->findOrFail($id);
            $params = $request->except('_token');
            if($request->image !== null){
                if($category->image !== null){
                    $image = base_path('assets/'.$category->image); 
                    unlink($image);
                }
                $filePath = $this->uploadImage('categories',$request->image);
                $params['image'] = $filePath;
                
            }
            $category->update($params);
            return redirect()->route('admin.categories')->with(['success' =>'Category '.$this->updated_msg]);
        }catch(\Exception $ex){
            return redirect()->route('admin.categories')->with(['error' => $this->error_msg]);
        }  
    }

    public function destroy($id)
    {
        try{
            $category = Category::whereNull('parent_id')->findOrFail($id);
            $image = base_path('assets/'.$category->image); 
            unlink($image);
            $category->delete();
            return redirect()->route('admin.categories')->with(['success' => 'Category '.$this->deleted_msg ]);
        }catch(\Exception $ex){
            return redirect()->route('admin.categories')->with(['error' => $this->error_msg]);
        } 
    }
}
