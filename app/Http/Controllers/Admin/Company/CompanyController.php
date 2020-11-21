<?php

namespace App\Http\Controllers\Admin\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\CompanyRequest;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index()
    {
        try{
            $companies = Company::paginate($this->pagination);
            return view('admin.companies.index',compact('companies'));
        }catch(\Exception $ex){
            return redirect()->route('admin.companies')->with(['error' =>  $this->error_msg]);
        }
        
    }

    
    public function create()
    {
        try{
           
            return view('admin.companies.create');  
        }catch(\Exception $ex){
            return redirect()->route('admin.companies')->with(['error' => $this->error_msg]);
        }
    }

    public function store(CompanyRequest $request)
    {
        try{
            $params = $request->except('_token');
            $filePath = $this->uploadImage('companies',$request->logo);
            $params['logo'] = $filePath;
            Company::create($params);
            return redirect()->route('admin.companies')->with(['success' => 'Company '.$this->added_msg]);
        }catch(\Exception $ex){
            
            dd($ex);
            return redirect()->route('admin.companies')->with(['error' => $this->error_msg]);
        }
     
    }

    public function show($id)
    {
        try{
           
            $company  = Company::findOrFail($id);
            $products = $company->products()->get();
            return view('admin.companies.show',compact('company','products'));
        }catch(\Exception $ex){
            dd($ex);
            return redirect()->route('admin.companies')->with(['error' => $this->error_msg]);
        }
    }

    public function edit($id)
    {
        try{
           
            $company  = Company::findOrFail($id);
            return view('admin.companies.edit',compact('company'));
        }catch(\Exception $ex){
            dd($ex);
            return redirect()->route('admin.companies')->with(['error' => $this->error_msg]);
        }
        
    }

    public function update(CompanyRequest $request, $id)
    {
        try{
            $company = Company::findOrFail($id);
            $params = $request->except('_token');
            if($request->logo !== null){
                $filePath = $this->uploadImage('companies',$request->logo);
                $params['logo'] = $filePath;
                $logo = base_path('assets/'.$company->logo); 
                unlink($logo);
            }
            $company->update($params);
            return redirect()->route('admin.companies')->with(['success' =>'Company '.$this->updated_msg]);
        }catch(\Exception $ex){
            dd($ex);
            return redirect()->route('admin.companies')->with(['error' => $this->error_msg]);
        }  
    }

    public function destroy($id)
    {
        try{
            $company = Company::findOrFail($id);
            $logo = base_path('assets/'.$company->logo); 
            unlink($logo);
            $company->delete();
            return redirect()->route('admin.companies')->with(['success' => 'Company '.$this->deleted_msg ]);
        }catch(\Exception $ex){
            return redirect()->route('admin.companies')->with(['error' => $this->error_msg]);
        } 
    }
}
