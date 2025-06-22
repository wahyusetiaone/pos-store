<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use App\Models\User;
use App\Models\Store;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Finance::with(['user', 'store']);

        // Filter by store if user doesn't have global access
        if (!auth()->user()->hasGlobalAccess()) {
            $query->where('store_id', auth()->user()->current_store_id);
        }

        $finances = $query->orderByDesc('id')->paginate(15);
        return view('finances.index', compact('finances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $stores = [];
        if (auth()->user()->hasGlobalAccess()) {
            $stores = Store::where('is_active', true)->get();
        }
        return view('finances.create', compact('users', 'stores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'type' => 'required|in:income,expense',
            'category' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'description' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
            'store_id' => auth()->user()->hasGlobalAccess() ? 'required|exists:stores,id' : 'prohibited'
        ]);

        // Set store_id based on user access
        if (auth()->user()->hasGlobalAccess()) {
            // Store ID from request for global access users
            $storeId = $request->store_id;
        } else {
            // Current store ID for non-global access users
            $storeId = auth()->user()->current_store_id;
        }

        // Add store_id to validated data
        $validated['store_id'] = $storeId;

        Finance::create($validated);
        return redirect()->route('finances.index')->with('success', 'Transaksi keuangan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Finance $finance)
    {
        $finance->load('user');
        return view('finances.show', compact('finance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Finance $finance)
    {
        $users = User::all();
        return view('finances.edit', compact('finance', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Finance $finance)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'type' => 'required|in:income,expense',
            'category' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'description' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ]);
        $finance->update($validated);
        return redirect()->route('finances.index')->with('success', 'Transaksi keuangan berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Finance $finance)
    {
        $finance->delete();
        return redirect()->route('finances.index')->with('success', 'Transaksi keuangan berhasil dihapus.');
    }
}
