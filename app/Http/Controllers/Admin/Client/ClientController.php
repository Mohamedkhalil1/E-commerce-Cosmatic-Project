<?php

namespace App\Http\Controllers\Admin\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\ClientRequest;
use App\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        try{
            if($request->searchValue){
                $clients = User::where('name', 'like', '%'.$request->searchValue.'%')
                ->paginate($this->pagination);
            }
            else{
                $clients = User::paginate($this->pagination);
            }
            
          
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
        try{
            $client  = User::findOrFail($id);
            $orders = $client->orders()->get();
            $products = $client->favourites()->get();
            return view('admin.clients.show',compact('client','orders','products'));
        }catch(\Exception $ex){
            dd($ex);
            return redirect()->route('admin.clients')->with(['error' => $this->error_msg]);
        }
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
