<?php

namespace App\Http\Controllers\Admin\Invoices;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierInvoiecController extends Controller
{
    public function index()
    {
        try{
            $invoices = Invoice::supplierInvoices()->get();
            return view('admin.suppliersInvoice.index',compact('invoices'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'حدث مشكله جرب مره اخرى']);
        }
    }

    public function create()
    {
        try{
            $suppliers = Supplier::all();
            return view('admin.suppliersInvoice.create',compact('suppliers'));
        }catch(\Exception $ex){
            return redirect()->route('admin.suppliersInvoice')->with(['error' => 'حدث مشكله جرب مره اخرى']);
        }
    }

    public function store(Request $request)
    {
        try{
            $params = $request->except('_token');
            Invoice::create($params);
            return redirect()->route('admin.suppliersInvoice')->with(['success' => 'تم إضافه الفاتوره بنجاح']);
        }catch(\Exception $ex){
            return redirect()->route('admin.suppliersInvoice')->with(['error' => 'حدث مشكله جرب مره اخرى']);
        }
       
    }

    public function edit($id)
    {
        try{
            $invoice = Invoice::supplierInvoices()->findOrFail($id);
            $suppliers = Supplier::all();
            return view('admin.suppliersInvoice.edit',compact('invoice','suppliers'));
        }catch(\Exception $ex){ 
            return redirect()->route('admin.suppliersInvoice')->with(['error' => 'حدث مشكله جرب مره اخرى']);
        }
      
    }

    public function update(Request $request, $id)
    {
        try{
            $params = $request->except('_token');
            Invoice::supplierInvoices()->findOrFail($id)->update($params);
            return redirect()->route('admin.suppliersInvoice')->with(['success' => 'تم تحديث الفاتوره بنجاح']);
        }catch(\Exception $ex){
            return redirect()->route('admin.suppliersInvoice')->with(['error' => 'حدث مشكله جرب مره اخرى']);
        }
      
    }

    public function destroy($id)
    {
        try{
            Invoice::supplierInvoices()->findOrFail($id)->delete();
            return redirect()->route('admin.suppliersInvoice')->with(['success' => 'تم حذف الفاتوره بنجاح']);
        }
        catch(\Exception $ex){
            return redirect()->route('admin.suppliersInvoice')->with(['error' => 'حدث مشكله جرب مره اخرى']);
        }
    }
}
