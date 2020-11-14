<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\ProductRequest;
use App\Models\Product;

use Illuminate\Http\Request;

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
            
            return view('admin.products.create');  
        }catch(\Exception $ex){
            return redirect()->route('admin.products')->with(['error' => $this->error_msg]);
        }
    }

    public function store(ProductRequest $request)
    {
    
        try{
            $params = $request->except('_token');
            $filePath = $this->uploadImage('products',$request->image);
            $params['image'] = $filePath;
            Product::create($params);
            return redirect()->route('admin.products')->with(['success' => 'Product '.$this->added_msg]);
        }catch(\Exception $ex){
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
           
            if($product === null){
                return redirect()->route('admin.products')->with(['error' => $this->error_msg]);
            }
            return view('admin.products.edit',compact('product'));
        }catch(\Exception $ex){
            dd($ex);
            return redirect()->route('admin.products')->with(['error' => $this->error_msg]);
        }
        
    }

    public function update(ProductRequest $request, $id)
    {
        try{
            $params = $request->except('_token');
            if($request->image !== null){
                $filePath = $this->uploadImage('products',$request->image);
                $params['image'] = $filePath;
            }
            Product::find($id)->update($params);
            return redirect()->route('admin.products')->with(['success' =>'Product '.$this->updated_msg]);
        }catch(\Exception $ex){
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
