<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;

class OrderController extends Controller
{
    public function index()
    {
        try{
            $orders = Order::paginate($this->pagination);
            return view('admin.orders.index',compact('orders'));
        }catch(\Exception $ex){
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

}
