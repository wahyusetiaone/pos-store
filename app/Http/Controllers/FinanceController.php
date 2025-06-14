<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use App\Models\User;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $finances = Finance::with('user')->paginate(15);
        return view('finances.index', compact('finances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('finances.create', compact('users'));
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
        ]);
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
