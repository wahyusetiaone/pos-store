<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Customer;
use App\Models\User;
use App\Models\SaleItem;
use App\Models\Store;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Sale::with(['customer', 'user']);

        // Filter by store if user doesn't have global access
        if (!auth()->user()->hasGlobalAccess()) {
            $query->where('store_id', auth()->user()->current_store_id);
        }

        $sales = $query->paginate(15);
        return view('sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $stores = [];
        if (auth()->user()->hasGlobalAccess()) {
            $stores = Store::where('is_active', true)->get();
        }

        $customers = Customer::query();
        if (!auth()->user()->hasGlobalAccess()) {
            $customers->where('store_id', auth()->user()->current_store_id);
        }
        $customers = $customers->get();

        return view('sales.create', compact('stores', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Create or get customer
            $customer = null;
            if ($request->customer_id) {
                $customer = Customer::find($request->customer_id);
            } elseif ($request->customer_name) {
                // Create new customer if doesn't exist
                $customer = Customer::create([
                    'name' => $request->customer_name,
                    'phone' => $request->customer_phone,
                    'store_id' => auth()->user()->hasGlobalAccess() ? $request->store_id : auth()->user()->current_store_id
                ]);
            }

            // Set store_id based on user access
            if (auth()->user()->hasGlobalAccess()) {
                $storeId = $request->store_id;
                if (!$storeId) {
                    throw new \Exception('Store ID is required for global access users');
                }
            } else {
                $storeId = auth()->user()->current_store_id;
            }

            // Create sale
            $sale = Sale::create([
                'store_id' => $storeId,
                'customer_id' => $customer ? $customer->id : null,
                'user_id' => auth()->id(),
                'sale_date' => now(),
                'total' => $request->total,
                'discount' => $request->discount,
                'paid' => $request->paid,
                'payment_method' => $request->payment_method,
                'note' => $request->note,
            ]);

            // Create sale items
            foreach ($request->items as $item) {
                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'discount' => $item['discount'] ?? 0,
                    'subtotal' => $item['quantity'] * $item['price'],
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil disimpan',
                'data' => $sale->load('items', 'customer')
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan transaksi: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        $sale->load(['customer', 'user', 'items']);
        return view('sales.show', compact('sale'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        $customers = Customer::all();
        $users = User::all();
        return view('sales.edit', compact('sale', 'customers', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'user_id' => 'required|exists:users,id',
            'sale_date' => 'required|date',
            'total' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'paid' => 'required|numeric',
            'payment_method' => 'required|string',
            'note' => 'nullable|string',
        ]);
        $sale->update($validated);
        return redirect()->route('sales.index')->with('success', 'Penjualan berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();
        return redirect()->route('sales.index')->with('success', 'Penjualan berhasil dihapus.');
    }
}
