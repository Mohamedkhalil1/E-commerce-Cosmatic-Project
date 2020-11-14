<?php

namespace App\Http\Controllers\Admin\Clients;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clients\ClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        try{
            $clients =  Client::select()->get();
            return view('admin.clients.index',compact('clients'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'حدث مشكله جرب مره اخرى']);
        }
        
    }

   
    public function create()
    {
        try{
            return view('admin.clients.create');
        }catch(\Exception $ex){
            return redirect()->route('admin.clients')->with(['error' => 'حدث مشكله جرب مره اخرى']);
        }
    }

    public function store(ClientRequest $request)
    {
        try{
            $params = $request->except('_token');
            Client::create($params);
            return redirect()->route('admin.clients')->with(['success' => 'تم إضافه العميل بنجاح']);
        }catch(\Exception $ex){
            return redirect()->route('admin.clients')->with(['error' => 'حدث مشكله جرب مره اخرى']);
        }
       
    }

    public function show($id)
    {
        try{
            $client =  Client::findOrFail($id);
            if($client === null){
                return redirect()->route('admin.clients')->with(['error' => ' هذا العميل غير موجود']);
            }
            $invoices = $client->invoices;
            return view('admin.clients.show',compact('client','invoices'));
        }catch(\Exception $ex){
            return redirect()->route('admin.clients')->with(['error' => 'حدث مشكله جرب مره اخرى']);
        }
       
    }

    public function edit($id)
    {
        try{
            $client = Client::findOrFail($id);
            if($client === null){
                return redirect()->route('admin.clients')->with(['error' => ' هذا العميل غير موجود']);
            }
            return view('admin.clients.edit',compact('client'));
        }catch(\Exception $ex){ 
            return redirect()->route('admin.clients')->with(['error' => 'حدث مشكله جرب مره اخرى']);
        }
      
    }

    public function update(ClientRequest $request, $id)
    {
        try{
            $params = $request->except('_token');
            Client::findOrFail($id)->update($params);
            return redirect()->route('admin.clients')->with(['success' => 'تم تحديث العميل بنجاح']);
        }catch(\Exception $ex){
            return redirect()->route('admin.clients')->with(['error' => 'حدث مشكله جرب مره اخرى']);
        }
      
    }

    public function destroy($id)
    {
        try{
            Client::findOrFail($id)->delete();
            return redirect()->route('admin.clients')->with(['success' => 'تم حذف العميل بنجاح']);
        }
        catch(\Exception $ex){
            return redirect()->route('admin.clients')->with(['error' => 'حدث مشكله جرب مره اخرى']);
        }
    }
}
