<?php

namespace App\Http\Controllers\Admin\Employees;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employees\EmployeeRequest;
use App\Models\Branch;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        try{
            $employees =  Employee::select()->get();
            return view('admin.employees.index',compact('employees'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'حدث مشكله جرب مره اخرى']);
        }
    }

    public function create()
    {
        try{
            $branches = Branch::select()->get();
            return view('admin.employees.create',compact('branches'));
        }catch(\Exception $ex){
            return redirect()->route('admin.employees')->with(['error' => 'حدث مشكله جرب مره اخرى']);
        }
    }

    public function store(EmployeeRequest $request)
    {
        try{
            $params = $request->except('_token');
            Employee::create($params);
            return redirect()->route('admin.employees')->with(['success' => 'تم إضافه الموظف بنجاح']);
        }catch(\Exception $ex){
            return redirect()->route('admin.employees')->with(['error' => 'حدث مشكله جرب مره اخرى']);
        }
       
    }

    public function show($id)
    {
        try{
            $employee =  Employee::findOrFail($id);
            $invoices = $employee->invoices;
            return view('admin.employees.show',compact('employee','invoices'));
        }catch(\Exception $ex){
            return redirect()->route('admin.employees')->with(['error' => 'حدث مشكله جرب مره اخرى']);
        }
       
    }

    public function edit($id)
    {
        try{
            $employee = Employee::findOrFail($id);
            $branches = Branch::select()->get();
            return view('admin.employees.edit',compact('employee','branches'));
        }catch(\Exception $ex){ 
            return redirect()->route('admin.employees')->with(['error' => 'حدث مشكله جرب مره اخرى']);
        }
      
    }

    public function update(EmployeeRequest $request, $id)
    {
        try{
            $params = $request->except('_token');
            Employee::findOrFail($id)->update($params);
            return redirect()->route('admin.employees')->with(['success' => 'تم تحديث موظف بنجاح']);
        }catch(\Exception $ex){
            return redirect()->route('admin.employees')->with(['error' => 'حدث مشكله جرب مره اخرى']);
        }
      
    }

    public function destroy($id)
    {
        try{
            Employee::findOrFail($id)->delete();
            return redirect()->route('admin.employees')->with(['success' => 'تم حذف موظف بنجاح']);
        }
        catch(\Exception $ex){
            return redirect()->route('admin.employees')->with(['error' => 'حدث مشكله جرب مره اخرى']);
        }
    }
}
