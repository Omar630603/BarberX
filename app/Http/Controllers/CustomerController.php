<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('admin.customerEdit', ['customer' => $customer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        Storage::delete('public/' . $customer->image);
        $customer->delete();
        return redirect()->route('customer.index')
            ->with('success', 'Customer seccesfully Deleted');
    }
}
