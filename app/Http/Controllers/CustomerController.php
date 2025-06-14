<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::query();

        // Search by name, phone, or email if provided
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('phone', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        // If it's an API request (Accept: application/json and Content-Type: application/json)
        if ($request->ajax() || $request->acceptsJson() && $request->isJson()) {
            return response()->json($query->limit(10)->get());
        }

        // For normal web request
        $customers = $query->paginate(15);
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:customers,email',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);
        Customer::create($validated);
        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
    }

    public function show(Customer $customer)
    {
        $customer->load('sales');
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:customers,email,' . $customer->id,
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);
        $customer->update($validated);
        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $customers = Customer::where('name', 'like', "%{$search}%")
            ->orWhere('phone', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->limit(10)
            ->get();

        if ($request->ajax()) {
            return response()->json($customers);
        }

        return $customers;
    }
}
