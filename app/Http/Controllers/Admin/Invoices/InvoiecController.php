<?php

namespace App\Http\Controllers\Admin\Invoices;

use App\Http\Controllers\Controller;
use App\Http\Requests\Invoices\InvoiceAddProductRequest;
use App\Http\Requests\Invoices\InvoiceRequest;
use App\Models\Branch;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\InvoiceProduct;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class InvoiecController extends Controller
{
    public function index(){
        try{
            $invoices = Invoice::clientInvoices()->orderBy('date','desc')->paginate(PAGINATION_COUNT);
            return view('admin.invoiecs.index',compact('invoices'));
        }catch(\Exception $ex){
            return redirect()->route('admin.invoices')->with(['error' => 'حدث مشكله جرب مره اخرى']);
        }
        
    }
    
    public function create(){
        $branches = Branch::select()->get();
        $clients = Client::select()->get();
        return view('admin.invoiecs.create',compact('clients','branches'));
    }
    
    public function addProduct($id,InvoiceAddProductRequest $request){
        try{
            DB::beginTransaction();
            $invoice = Invoice::clientInvoices()->findOrfail($id);
            if($invoice->status === 1){
                return redirect()->route('admin.invoices')->with(['error' => "هذه الفاتوره مدفوعه"]); 
            }
            $stock = Product::find($request->product_id)->stock;
            if($stock < $request->quantity){
                return redirect()->back()->with(['error' => "هذه الكميه غير متاحه الكميه المتاحه $stock"]);
            }
            if($invoice->products()->find($request->product_id) !== null){
                InvoiceProduct::where('product_id',$request->product_id)->where('invoice_id',$id)->update([
                    'quantity' => $request->quantity
                ]);
            }else{
               
                $product = Product::findOrFail($request->product_id);
                InvoiceProduct::create([
                    'price' => $product->price,
                    'quantity' => $request->quantity,
                    'product_id' => $request->product_id,
                    'invoice_id' => $id
                ]);
            }
            DB::commit();
            return redirect()->back()->with(['success' => 'تم اضافه المنتج لفاتوره']);
        }catch(\Exception $ex){
            DB::rollback();
            dd($ex);
            return redirect()->route('admin.invoices')->with(['error' => 'حدث مشكله جرب مره اخرى']);
        }
    }

    public function removeProduct($id,$product_id){
        try{
            $invoice = Invoice::clientInvoices()->findOrFail($id);
            if($invoice->status === 1){
                return redirect()->route('admin.invoices')->with(['error' => "هذه الفاتوره مدفوعه"]); 
            }
            InvoiceProduct::where('product_id',$product_id)->where('invoice_id',$id)->delete();
            return redirect()->back()->with(['success' => 'تم حذف المنتج لفاتوره']);
        }catch(\Exception $ex){
            return redirect()->route('admin.invoices')->with(['error' => 'حدث مشكله جرب مره اخرى']);
        }
    }

    public function finish($id){
        try{
            DB::beginTransaction();
            $invoice = Invoice::clientInvoices()->findOrFail($id);
            $products = InvoiceProduct::where('invoice_id',$id)->get();
             
            $amount =0.00;
            foreach($products as $product){
                $amount += $product->price * $product->quantity;
                $origin_product = Product::findOrFail($product->product_id);
                $origin_product->stock -= $product->quantity;
                $origin_product->save();
            }
            $invoice->price = $amount;
            $invoice->status = 1;
            $invoice->save();
            DB::commit();
            return  redirect()->route('admin.invoices')->with(['success' => 'تم انهاءالفاتوره']);
        }catch(\Exception $ex){
            dd($ex);
            DB::rollback();
            return redirect()->route('admin.invoices')->with(['error' => 'حدث مشكله جرب مره اخرى']);
        }
    }   

    public function showProduct($id){
        try{
            $invoice = Invoice::clientInvoices()->findOrfail($id);
            if($invoice->status === 1){
                return redirect()->route('admin.invoices')->with(['error' => "هذه الفاتوره مدفوعه"]); 
            }
            $products = Product::select()->where('branch_id',$invoice->branch_id)->paginate(PAGINATION_COUNT);
            return view('admin.invoiecs.products',compact('products','invoice'));
        }catch(\Exception $ex){
            return redirect()->route('admin.invoices')->with(['error' => 'حدث مشكله جرب مره اخرى']);
        }
       
    }

    public function store(InvoiceRequest $request){
        try{
            $params = $request->all();
            $params['type'] ='دفع';
            $invoice = Invoice::create($params);
            return redirect()->route('admin.invoices.showProduct',$invoice->id)->with(['success' => 'تم اضافه الفاتوره بنجاح يرجو اختيار المنتجات لحساب مبلغ الفاتوره']);
        }catch(\Exception $ex){
            return redirect()->route('admin.invoices')->with(['error' => 'حدث مشكله جرب مره اخرى']);
        }
    }

    public function show($id){
        try{
            $invoice = Invoice::clientInvoices()->findOrFail($id);
            $products = $invoice->products;
            $details = InvoiceProduct::where('invoice_id',$id)->paginate(PAGINATION_COUNT);
            return view ('admin.invoiecs.show',compact('invoice','products','details')); 
        }catch(\Exception $ex){
            return redirect()->route('admin.invoices')->with(['error' => 'حدث مشكله جرب مره اخرى']);
        }
    }

    public function edit($id){
        try{
            $invoice = Invoice::clientInvoices()->findOrFail($id);
            $branches = Branch::select()->get();
            $clients = Client::select()->get();
            return view('admin.invoiecs.edit',compact('clients','branches','invoice'));
        }catch(\Exception $ex){
            return redirect()->route('admin.invoices')->with(['error' => 'حدث مشكله جرب مره اخرى']);
        }
    }

    public function update($id,InvoiceRequest $request){
        try{
            $params = $request->all();
            $params['status'] = 0;
            Invoice::findOrFail($id)->update($params);
            return redirect()->route('admin.invoices.showProduct',$id);
        }catch(\Exception $ex){
            return redirect()->route('admin.invoices')->with(['error' => 'حدث مشكله جرب مره اخرى']);
        }
    }

    public function destroy($id){
        try{
            $invoice = Invoice::clientInvoices()->findOrFail($id);
            $invoice->delete();
            return redirect()->route('admin.invoices')->with(['success' => 'تم حذف الفاتوره بنجاح']);
        }catch(\Exception $ex){
            return redirect()->route('admin.invoices')->with(['error' => 'حدث مشكله جرب مره اخرى']);
        }
      
    }
}
