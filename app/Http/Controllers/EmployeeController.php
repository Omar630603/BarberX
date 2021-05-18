<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    
    public function index(Request $request)
    {
        $search = $request->get('search');
        if ($request->get('search')) {
            $employee = Employee::search(['name', 'skill', 'description'], $search)->get();
        } else {
            $employee = Employee::get();
        }
        return view('admin.employeeIndex', compact('employee'));
    }

   
    public function create()
    {
        
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'skill' => 'required',
            'description' => 'required',
            'image' => 'required',
        ]);

        if ($request->file('image')) {
            $image = $request->file('image')->store('images', 'public');
        }

        $employee = new Employee;
        $employee->name = $request->get('name');
        $employee->skill = $request->get('skill');
        $employee->description = $request->get('description');
        $employee->image = $image;

        $employee->save();


        return redirect()->route('employee.index')
            ->with('success', 'Employee Successfully Added');
    }

   
    public function show(Employee $employee)
    {
        //
    }

   
    public function edit(Employee $employee)
    {
        //
    }

   
    public function update(Request $request, Employee $employee)
    {
        //
    }


    public function destroy(Employee $employee)
    {
        //
    }
}
