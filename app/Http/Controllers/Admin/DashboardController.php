<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Client;
use App\Models\ContactUs;
use App\Models\Employee;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Product;
use App\Models\Supplier;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $orders = Order::OrderBy('id','desc')->limit(10)->get();
        $products = Product::OrderBy('id','desc')->limit(10)->get();
        $contacts = ContactUs::OrderBy('id','desc')->limit(10)->get();
        $clients = User::OrderBy('id','desc')->limit(10)->get();
        return view('admin.dashboard',compact('orders','products','contacts','clients'));
    }
}
