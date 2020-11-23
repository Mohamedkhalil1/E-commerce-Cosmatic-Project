<?php

namespace App\Http\Controllers\Admin\Ad;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ad\AdRequest;
use App\Models\Ad;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdController extends Controller
{
    public function index()
    {
        try{
            $ads = Ad::paginate($this->pagination);
            return view('admin.ads.index',compact('ads'));
        }catch(\Exception $ex){
            return redirect()->route('admin.ads')->with(['error' =>  $this->error_msg]);
        }
        
    }

    
    public function create()
    {
        try{
           
            return view('admin.ads.create');  
        }catch(\Exception $ex){
            return redirect()->route('admin.ads')->with(['error' => $this->error_msg]);
        }
    }

    public function store(AdRequest $request)
    {
        try{
            $params = $request->except('_token');
            $filePath = $this->uploadImage('offers',$request->image);
            $params['image'] = $filePath;
            Ad::create($params);
            return redirect()->route('admin.ads')->with(['success' => 'Ad '.$this->added_msg]);
        }catch(\Exception $ex){
            
            dd($ex);
            return redirect()->route('admin.ads')->with(['error' => $this->error_msg]);
        }
     
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        try{
           
            $ad  = Ad::findOrFail($id);
            return view('admin.ads.edit',compact('ad'));
        }catch(\Exception $ex){
            dd($ex);
            return redirect()->route('admin.ads')->with(['error' => $this->error_msg]);
        }
        
    }

    public function update(AdRequest $request, $id)
    {
        try{
            $ad = Ad::findOrFail($id);
            $params = $request->except('_token');
            if($request->image !== null){
                $filePath = $this->uploadImage('offers',$request->image);
                $params['image'] = $filePath;
                $image = base_path('assets/'.$ad->image); 
                unlink($image);
            }
            $ad->update($params);
            return redirect()->route('admin.ads')->with(['success' =>'Ad '.$this->updated_msg]);
        }catch(\Exception $ex){
            dd($ex);
            return redirect()->route('admin.ads')->with(['error' => $this->error_msg]);
        }  
    }

    public function destroy($id)
    {
        try{
            $ad = Ad::findOrFail($id);
            
           
            $image = base_path('assets/'.$ad->image); 
            unlink($image);
            $ad->delete();

            return redirect()->route('admin.ads')->with(['success' => 'Ad '.$this->deleted_msg ]);
        }catch(\Exception $ex){
            return redirect()->route('admin.ads')->with(['error' => $this->error_msg]);
        } 
    }

    public function addProduct($id,Request $request){
        try{
            DB::beginTransaction();
            $ad = Ad::findOrfail($id);
            if((int)$ad->status === 1){
                return redirect()->route('admin.ads')->with(['error' => $this->error_msg]); 
            }
            Product::where('id',$request->product_id)->update([
                'ad_id' => $id
            ]);
            DB::commit();
            return redirect()->back()->with(['success' => 'Product '.$this->added_msg]);
        }catch(\Exception $ex){
            DB::rollback();
            return redirect()->route('admin.ads')->with(['error' => $this->error_msg]);
        }
    }

    public function removeProduct($id,$product_id){
        try{
            $ad = Ad::findOrFail($id);
            if($ad->status === 1){
                return redirect()->route('admin.invoices')->with(['error' => $this->error_msg]); 
            }
            Product::where('id',$product_id)->update([
                'ad_id' => null
            ]);
            return redirect()->back()->with(['success' => 'Product '.$this->deleted_msg]);
        }catch(\Exception $ex){
            return redirect()->route('admin.invoices')->with(['error' => $this->error_msg]);
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
}
