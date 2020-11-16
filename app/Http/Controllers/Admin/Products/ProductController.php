<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
   
    public function index()
    {
        try{
            $products = Product::all();
            return view('admin.products.index',compact('products'));
        }catch(\Exception $ex){
            return redirect()->route('admin.products')->with(['error' =>  $this->error_msg]);
        }
        
    }

    
    public function create()
    {
        try{
            $categories = Category::whereNotNull('parent_id')->get();
            $brands = Brand::all();
            return view('admin.products.create',compact('categories','brands'));  
        }catch(\Exception $ex){
            return redirect()->route('admin.products')->with(['error' => $this->error_msg]);
        }
    }

    public function store(ProductRequest $request)
    {
    
        try{
            DB::beginTransaction();
            $params = $request->except('_token','category_id');
            
            $filePath = $this->uploadImage('products',$request->image);
            $params['image'] = $filePath;
            $product = Product::create($params);
            $product->categories()->syncWithoutDetaching($request->category_id);
            $category = Category::whereNotNull('parent_id')->findOrFail($request->category_id);
            $main_category = $category->category;
            $product->categories()->syncWithoutDetaching($main_category->id);
            DB::commit();
            return redirect()->route('admin.products')->with(['success' => 'Product '.$this->added_msg]);
        }catch(\Exception $ex){
            DB::rollback();
            dd($ex);
            return redirect()->route('admin.products')->with(['error' => $this->error_msg]);
        }
     
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        try{
           
            $product  = Product::find($id);
            $categories = Category::whereNotNull('parent_id')->get();
            $brands = Brand::all();
            if($product === null){
                return redirect()->route('admin.products')->with(['error' => $this->error_msg]);
            }
            return view('admin.products.edit',compact('product','categories','brands'));
        }catch(\Exception $ex){
            dd($ex);
            return redirect()->route('admin.products')->with(['error' => $this->error_msg]);
        }
        
    }

    public function update(ProductRequest $request, $id)
    {
        try{
            DB::beginTransaction();
            $product = Product::findOrFail($id);
            $params = $request->except('_token','category_id');
            if($request->image !== null){
                $filePath = $this->uploadImage('products',$request->image);
                $params['image'] = $filePath;
                $image = base_path('assets/'.$product->image); 
                unlink($image);
            }
            $product->categories()->syncWithoutDetaching($request->category_id);
            $category = Category::whereNotNull('parent_id')->findOrFail($request->category_id);
            $main_category = $category->category;
            $product->categories()->syncWithoutDetaching($main_category->id);
            $product->update($params);
            DB::commit();
            return redirect()->route('admin.products')->with(['success' =>'Product '.$this->updated_msg]);
        }catch(\Exception $ex){
            DB::rollback();
            dd($ex);
            return redirect()->route('admin.products')->with(['error' => $this->error_msg]);
        }  
    }

    public function destroy($id)
    {
        try{
            $product = Product::find($id);
            if(!$product){
                return redirect()->route('admin.maincategories')->with(['error' =>$this->error_msg]);
            }
           
            $image = base_path('assets/'.$product->image); 
            unlink($image);
            $product->delete();

            return redirect()->route('admin.products')->with(['success' => 'Product '.$this->deleted_msg ]);
        }catch(\Exception $ex){
            return redirect()->route('admin.products')->with(['error' => $this->error_msg]);
        } 
    }
}
