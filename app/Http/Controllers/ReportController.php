<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

        // Compute category summary for the filtered transactions
        $categorySummary = (clone $query)
            ->select('category', 'type', \DB::raw('SUM(amount) as total'))
            ->groupBy('category', 'type')
            ->get();

        return view('reports.index', compact('transactions', 'categories', 'categorySummary'));
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