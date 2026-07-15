<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    // SHOW ALL CUSTOMERS
    public function index()
    {
        $customers = Customer::where('user_id', Auth::id())
                        ->latest()
                        ->get();

        return view('customers.index', compact('customers'));
    }

    // SHOW CREATE FORM
    public function create()
    {
        return view('customers.create');
    }

    // STORE DATA
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'address' => 'nullable',
            'gst_number' => 'nullable'
        ]);

        Customer::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gst_number' => $request->gst_number,
            'state' => $request->state,
        ]);

        return redirect()->route('customers.index')
            ->with('success', 'Customer Created Successfully');
    }

    // SHOW EDIT FORM
    public function edit($id)
    {
        $customer = Customer::where('user_id', Auth::id())
                        ->findOrFail($id);

        return view('customers.edit', compact('customer'));
    }

    // UPDATE DATA
    public function update(Request $request, $id)
    {
        // dd($id);
        $customer = Customer::where('user_id', Auth::id())
                        ->findOrFail($id);

        $customer->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gst_number' => $request->gst_number,
            'state' => $request->state,
        ]);

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer Updated Successfully');
    }

    // DELETE DATA
    public function destroy($id)
    {
        $customer = Customer::where('user_id', Auth::id())
                        ->findOrFail($id);

        $customer->delete();

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer Deleted Successfully');
    }
}