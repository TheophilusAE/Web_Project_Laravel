<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\FinancialAnalysis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Get current month's transactions
        $currentMonth = Carbon::now()->startOfMonth();
        $transactions = Transaction::where('user_id', $user->id)
            ->whereMonth('transaction_date', $currentMonth->month)
            ->whereYear('transaction_date', $currentMonth->year)
            ->get();

        // Calculate monthly summary
        $monthlySummary = [
            'income' => $transactions->where('type', 'income')->sum('amount'),
            'expense' => $transactions->where('type', 'expense')->sum('amount'),
            'net' => $transactions->where('type', 'income')->sum('amount') - $transactions->where('type', 'expense')->sum('amount')
        ];

        // Compute totalIncome and totalExpenses (for example, using monthlySummary)
        $totalIncome = $monthlySummary['income'];
        $totalExpenses = $monthlySummary['expense'];

        // Compute savings rate (for example, (totalIncome – totalExpenses) / totalIncome, or zero if totalIncome is zero)
        $savingsRate = ($totalIncome > 0) ? (($totalIncome - $totalExpenses) / $totalIncome) * 100 : 0;

        // Compute monthly trends (for example, an array of monthly summaries for the last 6 months)
        $monthlyTrends = [];
        for ($i = 5; $i >= 0; --$i) {
            $month = Carbon::now()->subMonths($i)->startOfMonth();
            $monthlyTransactions = Transaction::where('user_id', $user->id)
                ->whereMonth('transaction_date', $month->month)
                ->whereYear('transaction_date', $month->year)
                ->get();
            $monthlyTrends[$month->format('M Y')] = [
                'income' => $monthlyTransactions->where('type', 'income')->sum('amount'),
                'expense' => $monthlyTransactions->where('type', 'expense')->sum('amount'),
                'net' => $monthlyTransactions->where('type', 'income')->sum('amount') - $monthlyTransactions->where('type', 'expense')->sum('amount')
            ];
        }

        // Compute category distribution (for example, an array of category summaries (sum of amounts) for the current month)
        $categoryDistribution = Transaction::where('user_id', $user->id)
            ->whereMonth('transaction_date', $currentMonth->month)
            ->whereYear('transaction_date', $currentMonth->year)
            ->select('category', DB::raw('SUM(amount) as total'))
            ->groupBy('category')
            ->get()
            ->pluck('total', 'category')
            ->toArray();

        // Get recent transactions
        $recentTransactions = Transaction::where('user_id', $user->id)
            ->orderBy('transaction_date', 'desc')
            ->take(5)
            ->get();

        // Get category-wise summary
        $categorySummary = Transaction::where('user_id', $user->id)
            ->whereMonth('transaction_date', $currentMonth->month)
            ->whereYear('transaction_date', $currentMonth->year)
            ->select('category', 'type', DB::raw('SUM(amount) as total'))
            ->groupBy('category', 'type')
            ->get();

        // Get latest financial analysis
        $latestAnalysis = FinancialAnalysis::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->first();

        $totalBalance = $monthlySummary['net'];

        return view('dashboard', compact(
            'monthlySummary',
            'recentTransactions',
            'categorySummary',
            'latestAnalysis',
            'totalBalance',
            'totalIncome',
            'totalExpenses',
            'savingsRate',
            'monthlyTrends',
            'categoryDistribution'
        ));
    }
} 