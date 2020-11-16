<?php

namespace App\Http\Controllers\Admin\Code;

use App\Http\Controllers\Controller;
use App\Http\Requests\Code\CodeRequest;
use App\Models\Code;


class CodeController extends Controller
{
    public function index()
    {
        try{
            $codes = Code::all();
            return view('admin.codes.index',compact('codes'));
        }catch(\Exception $ex){
            return redirect()->route('admin.codes')->with(['error' =>  $this->error_msg]);
        }
        
    }

    
    public function create()
    {
        try{
            return view('admin.codes.create');  
        }catch(\Exception $ex){
            return redirect()->route('admin.codes')->with(['error' => $this->error_msg]);
        }
    }

    public function store(CodeRequest $request)
    {
        try{
            $params = $request->except('_token');
            Code::create($params);
            return redirect()->route('admin.codes')->with(['success' => 'Code '.$this->added_msg]);
        }catch(\Exception $ex){
            dd($ex);
            return redirect()->route('admin.codes')->with(['error' => $this->error_msg]);
        }
     
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        try{
           
            $code  = Code::findOrFail($id);
            return view('admin.codes.edit',compact('code'));
        }catch(\Exception $ex){
            dd($ex);
            return redirect()->route('admin.codes')->with(['error' => $this->error_msg]);
        }
        
    }

    public function update(CodeRequest $request, $id)
    {
       
        try{
            $params = $request->except('_token');
           
            Code::findOrFail($id)->update($params);
            return redirect()->route('admin.codes')->with(['success' =>'Code '.$this->updated_msg]);
        }catch(\Exception $ex){
            return redirect()->route('admin.codes')->with(['error' => $this->error_msg]);
        }  
    }

    public function destroy($id)
    {
        try{
            $code = Code::findOrFail($id);
            $code->delete();
            return redirect()->route('admin.codes')->with(['success' => 'Code '.$this->deleted_msg ]);
        }catch(\Exception $ex){
            return redirect()->route('admin.codes')->with(['error' => $this->error_msg]);
        } 
    }
}
