<?php

namespace App\Http\Controllers\Admin\Division;

use App\Http\Controllers\Controller;
use App\Http\Requests\Division\DivisionRequest;
use App\Models\Deivison;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function index()
    {
        try{
            $divisions = Deivison::all();
            return view('admin.divisions.index',compact('divisions'));
        }catch(\Exception $ex){
            return redirect()->route('admin.divisions')->with(['error' =>  $this->error_msg]);
        }
        
    }

    
    public function create()
    {
        try{
            return view('admin.divisions.create');  
        }catch(\Exception $ex){
            return redirect()->route('admin.divisions')->with(['error' => $this->error_msg]);
        }
    }

    public function store(DivisionRequest $request)
    {
        try{
            $params = $request->except('_token');
            Deivison::create($params);
            return redirect()->route('admin.divisions')->with(['success' => 'Division '.$this->added_msg]);
        }catch(\Exception $ex){
            dd($ex);
            return redirect()->route('admin.divisions')->with(['error' => $this->error_msg]);
        }
     
    }

    public function show($id)
    {
        try{
           
            $division  = Deivison::findOrFail($id);
            $brands = $division->brands()->get();
            return view('admin.divisions.show',compact('division','brands'));
        }catch(\Exception $ex){
            dd($ex);
            return redirect()->route('admin.divisions')->with(['error' => $this->error_msg]);
        }
    }

    public function edit($id)
    {
        try{
           
            $division  = Deivison::findOrFail($id);
            return view('admin.divisions.edit',compact('division'));
        }catch(\Exception $ex){
            dd($ex);
            return redirect()->route('admin.divisions')->with(['error' => $this->error_msg]);
        }
        
    }

    public function update(DivisionRequest $request, $id)
    {
       
        try{
            $params = $request->except('_token');
           
            Deivison::findOrFail($id)->update($params);
            return redirect()->route('admin.divisions')->with(['success' =>'Division '.$this->updated_msg]);
        }catch(\Exception $ex){
            return redirect()->route('admin.divisions')->with(['error' => $this->error_msg]);
        }  
    }

    public function destroy($id)
    {
        try{
            $division = Deivison::findOrFail($id);
            $division->delete();
            return redirect()->route('admin.divisions')->with(['success' => 'Division '.$this->deleted_msg ]);
        }catch(\Exception $ex){
            return redirect()->route('admin.divisions')->with(['error' => $this->error_msg]);
        } 
    }
}
