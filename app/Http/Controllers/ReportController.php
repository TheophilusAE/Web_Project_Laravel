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
        $query = Transaction::where('transactions.user_id', $user->id);

        // Apply filters
        if ($request->filled('start_date')) {
            $query->whereDate('transaction_date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('transaction_date', '<=', $request->end_date);
        }
        if ($request->filled('type')) {
            $query->where('transactions.type', $request->type);
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $transactions = $query->with('category')->orderBy('transaction_date', 'desc')->paginate(10);
        
        // Get unique categories for filter
        // Fetch categories related to the authenticated user
        $categories = $user->categories()->select('id', 'name', 'type')->get();

        // Get expense categories with their amounts (including category name and color)
        $expenseCategories = $user->transactions()
            ->where('transactions.type', 'expense')
            ->join('categories', 'transactions.category_id', '=', 'categories.id')
            ->select('categories.name as category_name', 'categories.color as category_color', DB::raw('SUM(transactions.amount) as amount'))
            ->groupBy('category_id', 'categories.name', 'categories.color')
            ->orderBy('amount', 'desc')
            ->get();

        // Get income categories with their amounts (including category name and color)
        $incomeCategories = $user->transactions()
            ->where('transactions.type', 'income')
            ->join('categories', 'transactions.category_id', '=', 'categories.id')
            ->select('categories.name as category_name', 'categories.color as category_color', DB::raw('SUM(transactions.amount) as amount'))
            ->groupBy('category_id', 'categories.name', 'categories.color')
            ->orderBy('amount', 'desc')
            ->get();

        // Get category comparison data
        $categoryComparison = $user->transactions()
            ->join('categories', 'transactions.category_id', '=', 'categories.id')
            ->select('categories.name as category_name',
                    DB::raw('SUM(CASE WHEN transactions.type = "income" THEN transactions.amount ELSE 0 END) as income'),
                    DB::raw('SUM(CASE WHEN transactions.type = "expense" THEN transactions.amount ELSE 0 END) as expense'))
            ->groupBy('category_id', 'categories.name')
            ->orderBy('categories.name')
            ->get();

        // Get monthly trends data
        $monthlyTrends = Transaction::where('transactions.user_id', $user->id)
            ->whereYear('transactions.transaction_date', Carbon::now()->year)
            ->select(
                DB::raw('DATE_FORMAT(transactions.transaction_date, "%M") as month'),
                DB::raw('SUM(CASE WHEN transactions.type = "income" THEN transactions.amount ELSE 0 END) as income'),
                DB::raw('SUM(CASE WHEN transactions.type = "expense" THEN transactions.amount ELSE 0 END) as expense'),
                DB::raw('SUM(CASE WHEN transactions.type = "income" THEN transactions.amount ELSE -transactions.amount END) as net')
            )
            ->groupBy('month')
            ->orderBy(DB::raw('MONTH(transactions.transaction_date)'))
            ->get();

        // Get savings rate trend data
        $savingsRateTrend = Transaction::where('transactions.user_id', $user->id)
            ->whereYear('transactions.transaction_date', Carbon::now()->year)
            ->select(
                DB::raw('DATE_FORMAT(transactions.transaction_date, "%M") as month'),
                DB::raw('SUM(CASE WHEN transactions.type = "income" THEN transactions.amount ELSE 0 END) as income'),
                DB::raw('SUM(CASE WHEN transactions.type = "expense" THEN transactions.amount ELSE 0 END) as expense')
            )
            ->groupBy('month')
            ->orderBy(DB::raw('MONTH(transactions.transaction_date)'))
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
        // Categories are now dynamically loaded via AJAX in the frontend
        return view('reports.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:income,expense',
            'category_id' => ['required', 'integer', 'exists:categories,id'], // Validate category_id exists in categories table
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