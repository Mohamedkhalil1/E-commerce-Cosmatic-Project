<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        try{
            if($request->searchValue){
                $orders = Order::where('amount',$request->searchValue)
                ->orWhere('invoice_num', 'like', '%'.$request->searchValue.'%')
                ->orWhere('city', 'like', '%'.$request->searchValue.'%')
                ->orWhere('region', 'like', '%'.$request->searchValue.'%')
                ->orWhereHas('user',function($q) use($request) {
                    $q->where('name','like','%'.$request->searchValue.'%');
                })
                ->orderBy('id', 'desc')
                ->paginate($this->pagination);;
            }elseif($request->sort){
                if($request->sort === 'amount desc'){
                    $orders = Order::orderBy('amount', 'desc')->paginate($this->pagination);;
                }else{
                    $orders = Order::orderBy($request->sort, 'asc')->paginate($this->pagination);
                }
            }else{
                $orders = Order::paginate($this->pagination);  
            }

          
            return view('admin.orders.index',compact('orders'));
        }catch(\Exception $ex){
            dd($ex);
            return redirect()->route('admin.orders')->with(['error' =>  $this->error_msg]);
        }
    }

    public function show($id)
    {
        try{
            $order = Order::findOrFail($id);
            $details = OrderDetails::where('order_id',$id)->get();
            return view('admin.orders.show',compact('order','details'));
        }catch(\Exception $ex){
            return redirect()->route('admin.orders')->with(['error' =>  $this->error_msg]);
        }
    }

    public function changeStatus($id){
        try{
            $order = Order::findOrFail($id);
            $order->done= !$order->done;
            $order->save();
            if((int)$order->done === 0){
                $msg = "Order is cancelled";
                $type="error";
                
            }else{
                $msg = "Order is done";
                $type ="success";
               
            }
            return redirect()->back()->with([$type => $msg]);
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' =>  $this->error_msg]);
        }
    }
}
