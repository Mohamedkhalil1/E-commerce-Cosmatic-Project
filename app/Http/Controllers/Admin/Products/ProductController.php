<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\ProductRequest;
use App\Models\Branch;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
   
    public function index()
    {
        try{
            $products = Product::select()->get();
            return view('admin.products.index',compact('products'));
        }catch(\Exception $ex){
            return redirect()->route('admin.products')->with(['error' => 'حدث مشكله جرب مره اخرى']);
        }
        
    }

    
    public function create()
    {
        try{
            $branches = Branch::select()->get();
            return view('admin.products.create',compact('branches'));  
        }catch(\Exception $ex){
            return redirect()->route('admin.products')->with(['error' => 'حدث مشكله جرب مره اخرى']);
        }
    }

    public function store(ProductRequest $request)
    {
        try{
            $params = $request->except('_token');
            Product::create($params);
            return redirect()->route('admin.products')->with(['success' => 'تم إضافه المنتج بنجاح']);
        }catch(\Exception $ex){
            return redirect()->route('admin.products')->with(['error' => 'حدث مشكله جرب مره اخرى']);
        }
     
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        try{
            $branches = Branch::select()->get();
            $product  = Product::find($id);
            if($product === null){
                return redirect()->route('admin.products')->with(['error' => 'هذا المنتج غير موجود']);
            }
            return view('admin.products.edit',compact('branches','product'));
        }catch(\Exception $ex){
            return redirect()->route('admin.products')->with(['error' => 'حدث مشكله جرب مره اخرى']);
        }
        
    }

    public function update(ProductRequest $request, $id)
    {
        try{
            $params = $request->except('_token');
            Product::find($id)->update($params);
            return redirect()->route('admin.products')->with(['success' => 'تم تحديث المنتج بنجاح']);
        }catch(\Exception $ex){
            return redirect()->route('admin.products')->with(['error' => 'حدث مشكله جرب مره اخرى']);
        }  
    }

    public function destroy($id)
    {
        try{
            Product::find($id)->delete();
            return redirect()->route('admin.products')->with(['success' => 'تم حذف المنتج بنجاح']);
        }catch(\Exception $ex){
            return redirect()->route('admin.products')->with(['error' => 'حدث مشكله جرب مره اخرى']);
        } 
    }
}
