<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Client;
use App\Models\Employee;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $invoices = Invoice::clientInvoices()->orderBy('id','desc')->limit(PAGINATION_COUNT)->get();
        $branches = Branch::orderBy('id','desc')->limit(PAGINATION_COUNT)->get();
        $products = Product::orderBy('id','desc')->limit(PAGINATION_COUNT)->get();
        $employees = Employee::orderBy('id','desc')->limit(PAGINATION_COUNT)->get();
        $suppliers= Supplier::orderBy('id','desc')->limit(PAGINATION_COUNT)->get();
        $clients  = Client::orderBy('id','desc')->limit(PAGINATION_COUNT)->get();
        return view('admin.dashboard',compact('invoices','products','branches','employees','suppliers','clients'));
    }
}
