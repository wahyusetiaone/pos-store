<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Sale;
use App\Models\Purchase;
use App\Models\Customer;
use App\Models\Finance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $lastMonth = Carbon::now()->subMonth();
        $thisYear = Carbon::now()->startOfYear();

        // Sales Statistics & Growth
        $todaySales = Sale::whereDate('sale_date', $today)->sum('total');
        $monthSales = Sale::whereMonth('sale_date', $today->month)->sum('total');
        $lastMonthSales = Sale::whereMonth('sale_date', $lastMonth->month)->sum('total');
        $salesGrowth = $lastMonthSales > 0 ? (($monthSales - $lastMonthSales) / $lastMonthSales * 100) : 0;

        // Purchase Statistics & Growth
        $totalPurchasesThisMonth = Purchase::whereMonth('purchase_date', $today->month)->sum('total');
        $totalPurchasesLastMonth = Purchase::whereMonth('purchase_date', $lastMonth->month)->sum('total');
        $purchaseGrowth = $totalPurchasesLastMonth > 0 ? (($totalPurchasesThisMonth - $totalPurchasesLastMonth) / $totalPurchasesLastMonth * 100) : 0;

        // Monthly Income & Expense Data for Chart
        $monthlyIncomes = [];
        $monthlyExpenses = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyIncomes[] = Finance::where('type', 'income')
                ->whereYear('date', $today->year)
                ->whereMonth('date', $i)
                ->sum('amount');

            $monthlyExpenses[] = Finance::where('type', 'expense')
                ->whereYear('date', $today->year)
                ->whereMonth('date', $i)
                ->sum('amount');
        }

        // Weekly Sales & Purchases for Chart
        $weeklySales = [];
        $weeklyPurchases = [];
        for ($i = 0; $i < 7; $i++) {
            $date = Carbon::now()->startOfWeek()->addDays($i);
            $weeklySales[] = Sale::whereDate('sale_date', $date)->sum('total');
            $weeklyPurchases[] = Purchase::whereDate('purchase_date', $date)->sum('total');
        }

        // Financial Statistics & Growth
        $incomeThisMonth = Finance::where('type', 'income')
            ->whereMonth('date', $today->month)
            ->sum('amount');
        $incomeLastMonth = Finance::where('type', 'income')
            ->whereMonth('date', $lastMonth->month)
            ->sum('amount');
        $incomeGrowth = $incomeLastMonth > 0 ? (($incomeThisMonth - $incomeLastMonth) / $incomeLastMonth * 100) : 0;

        $expensesThisMonth = Finance::where('type', 'expense')
            ->whereMonth('date', $today->month)
            ->sum('amount');
        $expensesLastMonth = Finance::where('type', 'expense')
            ->whereMonth('date', $lastMonth->month)
            ->sum('amount');
        $expenseGrowth = $expensesLastMonth > 0 ? (($expensesThisMonth - $expensesLastMonth) / $expensesLastMonth * 100) : 0;

        // Overall Report Percentages
        $totalPurchases = Purchase::whereMonth('purchase_date', $today->month)->sum('total');
        $totalSales = Sale::whereMonth('sale_date', $today->month)->sum('total');
        $totalExpenses = Finance::where('type', 'expense')
            ->whereMonth('date', $today->month)
            ->sum('amount');
        $grossProfit = $totalSales - $totalPurchases - $totalExpenses;

        $total = $totalPurchases + $totalSales + $totalExpenses + max(0, $grossProfit);
        $totalPurchases = $total > 0 ? ($totalPurchases / $total * 100) : 0;
        $totalSales = $total > 0 ? ($totalSales / $total * 100) : 0;
        $totalExpenses = $total > 0 ? ($totalExpenses / $total * 100) : 0;
        $grossProfit = $total > 0 ? (max(0, $grossProfit) / $total * 100) : 0;

        // Recent Sales
        $recentSales = Sale::with(['customer'])
            ->orderBy('sale_date', 'desc')
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'todaySales',
            'monthSales',
            'salesGrowth',
            'totalPurchasesThisMonth',
            'purchaseGrowth',
            'incomeThisMonth',
            'incomeGrowth',
            'expensesThisMonth',
            'expenseGrowth',
            'monthlyIncomes',
            'monthlyExpenses',
            'weeklySales',
            'weeklyPurchases',
            'totalPurchases',
            'totalSales',
            'totalExpenses',
            'grossProfit',
            'recentSales'
        ));
    }

    public function index2()
    {
        return view('dashboard/index2');
    }

    public function index3()
    {
        return view('dashboard/index3');
    }

    public function index4()
    {
        return view('dashboard/index4');
    }

    public function index5()
    {
        return view('dashboard/index5');
    }

    public function index6()
    {
        return view('dashboard/index6');
    }

    public function index7()
    {
        return view('dashboard/index7');
    }

    public function index8()
    {
        return view('dashboard/index8');
    }

    public function index9()
    {
        return view('dashboard/index9');
    }

    public function index10()
    {
        return view('dashboard/index10');
    }

    public function pos()
    {
        $products = Product::with(['category', 'images'])->get();
        $categories = Category::all();
        return view('dashboard.pos', compact('products', 'categories'));
    }
}
