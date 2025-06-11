<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $query = Transaction::where('user_id', $user->id);

        // Apply filters
        if ($request->filled('start_date')) {
            $query->whereDate('transaction_date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('transaction_date', '<=', $request->end_date);
        }
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $transactions = $query->orderBy('transaction_date', 'desc')->paginate(10);
        
        // Get unique categories for filter
        $categories = Transaction::where('user_id', $user->id)
            ->distinct()
            ->pluck('category');

        // Get expense categories with their amounts
        $expenseCategories = Transaction::where('user_id', $user->id)
            ->where('type', 'expense')
            ->select('category', DB::raw('SUM(amount) as amount'))
            ->groupBy('category')
            ->orderBy('amount', 'desc')
            ->get();

        // Get income categories with their amounts
        $incomeCategories = Transaction::where('user_id', $user->id)
            ->where('type', 'income')
            ->select('category', DB::raw('SUM(amount) as amount'))
            ->groupBy('category')
            ->orderBy('amount', 'desc')
            ->get();

        // Get category comparison data
        $categoryComparison = Transaction::where('user_id', $user->id)
            ->select('category', 
                    DB::raw('SUM(CASE WHEN type = "income" THEN amount ELSE 0 END) as income'),
                    DB::raw('SUM(CASE WHEN type = "expense" THEN amount ELSE 0 END) as expense'))
            ->groupBy('category')
            ->orderBy('category')
            ->get();

        // Get monthly trends data
        $monthlyTrends = Transaction::where('user_id', $user->id)
            ->whereYear('transaction_date', Carbon::now()->year)
            ->select(
                DB::raw('DATE_FORMAT(transaction_date, "%M") as month'),
                DB::raw('SUM(CASE WHEN type = "income" THEN amount ELSE 0 END) as income'),
                DB::raw('SUM(CASE WHEN type = "expense" THEN amount ELSE 0 END) as expense'),
                DB::raw('SUM(CASE WHEN type = "income" THEN amount ELSE -amount END) as net')
            )
            ->groupBy('month')
            ->orderBy(DB::raw('MONTH(transaction_date)'))
            ->get();

        // Get savings rate trend data
        $savingsRateTrend = Transaction::where('user_id', $user->id)
            ->whereYear('transaction_date', Carbon::now()->year)
            ->select(
                DB::raw('DATE_FORMAT(transaction_date, "%M") as month'),
                DB::raw('SUM(CASE WHEN type = "income" THEN amount ELSE 0 END) as income'),
                DB::raw('SUM(CASE WHEN type = "expense" THEN amount ELSE 0 END) as expense')
            )
            ->groupBy('month')
            ->orderBy(DB::raw('MONTH(transaction_date)'))
            ->get()
            ->map(function ($item) {
                $item->rate = $item->income > 0 ? (($item->income - $item->expense) / $item->income) * 100 : 0;
                return $item;
            });

        return view('reports.index', compact(
            'transactions',
            'categories',
            'expenseCategories',
            'incomeCategories',
            'categoryComparison',
            'monthlyTrends',
            'savingsRateTrend'
        ));
    }

    public function create()
    {
        $categories = [
            'Washing Services',
            'Sanitizing Services',
            'Polishing Services',
            'Accessory Sales',
            'Membership Fees',
            'Cleaning Supplies',
            'Utilities',
            'Rent',
            'Salaries',
            'Equipment Maintenance',
            'Marketing',
            'Packaging',
        ];
            
        return view('reports.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:income,expense',
            'category' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'transaction_date' => 'required|date',
        ]);

        $transaction = auth()->user()->transactions()->create($validated);

        return redirect()->route('reports.index')
            ->with('success', 'Transaction recorded successfully.');
    }

    public function destroy(Transaction $transaction)
    {
        if ($transaction->user_id !== auth()->id()) {
            abort(403);
        }

        $transaction->delete();

        return redirect()->route('reports.index')
            ->with('success', 'Transaction deleted successfully.');
    }
} 