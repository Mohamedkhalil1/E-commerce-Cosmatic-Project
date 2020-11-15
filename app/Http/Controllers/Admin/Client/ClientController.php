<?php

namespace App\Http\Controllers\Admin\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\ClientRequest;
use App\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        try{
            $clients = User::all();
            return view('admin.clients.index',compact('clients'));
        }catch(\Exception $ex){
            return redirect()->route('admin.clients')->with(['error' =>  $this->error_msg]);
        }
        
    }

    
    public function create()
    {
        try{
            return view('admin.clients.create');  
        }catch(\Exception $ex){
            return redirect()->route('admin.clients')->with(['error' => $this->error_msg]);
        }
    }

    public function store(ClientRequest $request)
    {
        try{
            $params = $request->except('_token');
            $params['password'] = bcrypt($request->password);
            User::create($params);
            return redirect()->route('admin.clients')->with(['success' => 'Client '.$this->added_msg]);
        }catch(\Exception $ex){
            dd($ex);
            return redirect()->route('admin.clients')->with(['error' => $this->error_msg]);
        }
     
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        try{
           
            $client  = User::findOrFail($id);
            return view('admin.clients.edit',compact('client'));
        }catch(\Exception $ex){
            dd($ex);
            return redirect()->route('admin.clients')->with(['error' => $this->error_msg]);
        }
        
    }

    public function update(ClientRequest $request, $id)
    {
       
        try{
            $params = $request->except('_token','password');
            if($request->password !== null){
                $params['password'] = bcrypt($request->password);
            }
            User::findOrFail($id)->update($params);
            return redirect()->route('admin.clients')->with(['success' =>'Client '.$this->updated_msg]);
        }catch(\Exception $ex){
            return redirect()->route('admin.clients')->with(['error' => $this->error_msg]);
        }  
    }

    public function destroy($id)
    {
        try{
            $client = User::findOrFail($id);
            $client->delete();
            return redirect()->route('admin.clients')->with(['success' => 'Client '.$this->deleted_msg ]);
        }catch(\Exception $ex){
            return redirect()->route('admin.clients')->with(['error' => $this->error_msg]);
        } 
    }
}
