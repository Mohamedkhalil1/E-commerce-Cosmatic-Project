<?php

namespace App\Http\Controllers\Admin\Suppliers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Suppliers\SupplierRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        try{
            $suppliers =  Supplier::select()->get();
            return view('admin.suppliers.index',compact('suppliers'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'حدث مشكله جرب مره اخرى']);
        }
        
    }

   
    public function create()
    {
        try{
            return view('admin.suppliers.create');
        }catch(\Exception $ex){
            return redirect()->route('admin.suppliers')->with(['error' => 'حدث مشكله جرب مره اخرى']);
        }
    }

    public function store(SupplierRequest $request)
    {
        try{
            $params = $request->except('_token');
            Supplier::create($params);
            return redirect()->route('admin.suppliers')->with(['success' => 'تم إضافه مزود بنجاح']);
        }catch(\Exception $ex){
            return redirect()->route('admin.suppliers')->with(['error' => 'حدث مشكله جرب مره اخرى']);
        }
       
    }

    public function show($id)
    {
        try{
            $supplier =  Supplier::find($id);
            if($supplier === null){
                return redirect()->route('admin.suppliers')->with(['error' => ' هذا المزود غير موجود']);
            }
            $invoices = $supplier->invoices;
            return view('admin.suppliers.show',compact('supplier','invoices'));
        }catch(\Exception $ex){
            return redirect()->route('admin.suppliers')->with(['error' => 'حدث مشكله جرب مره اخرى']);
        }
       
    }

    public function edit($id)
    {
        try{
            $supplier = Supplier::find($id);
            if($supplier === null){
                return redirect()->route('admin.suppliers')->with(['error' => ' هذا الفرع غير موجود']);
            }
            return view('admin.suppliers.edit',compact('supplier'));
        }catch(\Exception $ex){ 
            return redirect()->route('admin.suppliers')->with(['error' => 'حدث مشكله جرب مره اخرى']);
        }
      
    }

    public function update(SupplierRequest $request, $id)
    {
        try{
            $params = $request->except('_token');
            Supplier::find($id)->update($params);
            return redirect()->route('admin.suppliers')->with(['success' => 'تم تحديث المزود بنجاح']);
        }catch(\Exception $ex){
            return redirect()->route('admin.suppliers')->with(['error' => 'حدث مشكله جرب مره اخرى']);
        }
      
    }

    public function destroy($id)
    {
        try{
            Supplier::findOrFail($id)->delete();
            return redirect()->route('admin.suppliers')->with(['success' => 'تم حذف المزود بنجاح']);
        }
        catch(\Exception $ex){
            return redirect()->route('admin.suppliers')->with(['error' => 'حدث مشكله جرب مره اخرى']);
        }
    }
}
