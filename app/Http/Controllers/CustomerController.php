<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        return view('hr.customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('hr.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'balance' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
        ]);

        Customer::create($data);

        return redirect()->route('hr.customer.index')->with([
            'status' => 'success',
            'message' => 'Customer has been successfully created!'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('hr.customer.index')->with([
            'status' => 'success',
            'message' => 'Customer has been successfully deleted!'
        ]);
    }
}
