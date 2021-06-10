<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
   
    public function index(Request $request)
    {
        $search = $request->get('search');
        if ($request->get('search')) {
            $customers = Customer::search(['name', 'email', 'phone'], $search)->get();
        } else {
            $customers = Customer::get();
        }
        return view('admin.customerIndex', compact('customers'));
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);
        $customer = new Customer;
        if ($request->file('image')) {
            $image = $request->file('image')->store('images', 'public');
            $customer->image = $image;
        }
        $customer->name = $request->get('name');
        $customer->email = $request->get('email');
        $customer->phone = $request->get('phone');
        $customer->save();

        return redirect()->route('customer.index')
            ->with('success', 'New Customer Added Succesfully');
    }

    
    public function show(Customer $customer)
    {
        //
    }

    
    public function edit(Customer $customer)
    {
        return view('admin.customerEdit', ['customer' => $customer]);
    }

    
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'image' => 'nullable',

        ]);
        if ($request->file('image')) {
            if ($customer->image) {
                Storage::delete('public/' . $customer->image);
            }
            $image = $request->file('image')->store('images', 'public');
            $customer->image = $image;
        }

        $customer->name = $request->get('name');
        $customer->phone = $request->get('phone');
        $customer->email = $request->get('email');
        $customer->save();

        return redirect()->route('customer.index')
            ->with('success', 'Customer seccesfully Updated');
    }

    
    public function destroy(Customer $customer)
    {
        Storage::delete('public/' . $customer->image);
        $customer->delete();
        return redirect()->route('customer.index')
            ->with('success', 'Customer seccesfully Deleted');
    }
}
