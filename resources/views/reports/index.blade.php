@extends('layouts.app')

@section('title', 'Reports - Finapp')

@section('header', 'Financial Reports')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="card bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6" data-aos="fade-up">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Financial Reports</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Track and analyze your financial transactions</p>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('reports.create') }}" 
                   class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-150">
                    <i class="fas fa-plus mr-2"></i>
                    New Transaction
                </a>
            </div>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- Total Income -->
        <div class="card bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900 dark:to-green-800 rounded-lg shadow-lg p-6 transform hover:scale-105 transition-transform duration-200" data-aos="fade-up" data-aos-delay="100">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-gray-600 dark:text-gray-300 text-sm font-medium">Total Income</h3>
                    <p class="text-2xl font-bold text-green-600 dark:text-green-400 mt-2">
                        Rp {{ number_format($transactions->where('type', 'income')->sum('amount'), 0, ',', '.') }}
                    </p>
                </div>
                <div class="w-12 h-12 rounded-full bg-green-100 dark:bg-green-800 flex items-center justify-center">
                    <i class="fas fa-arrow-up text-green-600 dark:text-green-400 text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-center text-sm text-green-600 dark:text-green-400">
                    <span class="font-medium">This Month</span>
                </div>
            </div>
        </div>

        <!-- Total Expenses -->
        <div class="card bg-gradient-to-br from-red-50 to-red-100 dark:from-red-900 dark:to-red-800 rounded-lg shadow-lg p-6 transform hover:scale-105 transition-transform duration-200" data-aos="fade-up" data-aos-delay="200">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-gray-600 dark:text-gray-300 text-sm font-medium">Total Expenses</h3>
                    <p class="text-2xl font-bold text-red-600 dark:text-red-400 mt-2">
                        Rp {{ number_format($transactions->where('type', 'expense')->sum('amount'), 0, ',', '.') }}
                    </p>
                </div>
                <div class="w-12 h-12 rounded-full bg-red-100 dark:bg-red-800 flex items-center justify-center">
                    <i class="fas fa-arrow-down text-red-600 dark:text-red-400 text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-center text-sm text-red-600 dark:text-red-400">
                    <span class="font-medium">This Month</span>
                </div>
            </div>
        </div>

        <!-- Net Balance -->
        <div class="card bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900 dark:to-blue-800 rounded-lg shadow-lg p-6 transform hover:scale-105 transition-transform duration-200" data-aos="fade-up" data-aos-delay="300">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-gray-600 dark:text-gray-300 text-sm font-medium">Net Balance</h3>
                    <p class="text-2xl font-bold text-blue-600 dark:text-blue-400 mt-2">
                        Rp {{ number_format($transactions->where('type', 'income')->sum('amount') - $transactions->where('type', 'expense')->sum('amount'), 0, ',', '.') }}
                    </p>
                </div>
                <div class="w-12 h-12 rounded-full bg-blue-100 dark:bg-blue-800 flex items-center justify-center">
                    <i class="fas fa-balance-scale text-blue-600 dark:text-blue-400 text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-center text-sm text-blue-600 dark:text-blue-400">
                    <span class="font-medium">This Month</span>
                </div>
            </div>
        </div>

        <!-- Savings Rate -->
        <div class="card bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900 dark:to-purple-800 rounded-lg shadow-lg p-6 transform hover:scale-105 transition-transform duration-200" data-aos="fade-up" data-aos-delay="400">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-gray-600 dark:text-gray-300 text-sm font-medium">Savings Rate</h3>
                    @php
                        $income = $transactions->where('type', 'income')->sum('amount');
                        $expenses = $transactions->where('type', 'expense')->sum('amount');
                        $savingsRate = $income > 0 ? (($income - $expenses) / $income) * 100 : 0;
                    @endphp
                    <p class="text-2xl font-bold text-purple-600 dark:text-purple-400 mt-2">
                        {{ number_format($savingsRate, 1) }}%
                    </p>
                </div>
                <div class="w-12 h-12 rounded-full bg-purple-100 dark:bg-purple-800 flex items-center justify-center">
                    <i class="fas fa-piggy-bank text-purple-600 dark:text-purple-400 text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-center text-sm text-purple-600 dark:text-purple-400">
                    <span class="font-medium">This Month</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Visualization: Income & Expenses by Category -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
        <div class="relative" style="height: 300px;">
            <canvas id="categoryStackedChart"></canvas>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Expense Distribution Chart -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
            <div class="relative" style="height: 300px;">
                <canvas id="expenseDistributionChart"></canvas>
            </div>
        </div>

        <!-- Income Distribution Chart -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
            <div class="relative" style="height: 300px;">
                <canvas id="incomeDistributionChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Category Comparison Chart -->
    <div class="card bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6" data-aos="fade-up" data-aos-delay="300">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                <i class="fas fa-chart-bar text-indigo-500 mr-2"></i>
                Category Comparison
            </h3>
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 rounded-full bg-green-500"></div>
                    <span class="text-sm text-gray-600 dark:text-gray-400">Income</span>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 rounded-full bg-red-500"></div>
                    <span class="text-sm text-gray-600 dark:text-gray-400">Expenses</span>
                </div>
            </div>
        </div>
        <div class="relative" style="height: 400px;">
            <canvas id="categoryComparisonChart"></canvas>
        </div>
    </div>

    <!-- Monthly Trends Chart -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
        <div class="relative" style="height: 300px;">
            <canvas id="monthlyTrendsChart"></canvas>
        </div>
    </div>

    <!-- Savings Rate Chart -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
        <div class="relative" style="height: 300px;">
            <canvas id="savingsRateChart"></canvas>
        </div>
    </div>

    <!-- Transactions Table -->
    <div class="card bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden" data-aos="fade-up" data-aos-delay="600">
        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Recent Transactions</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Type</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Category</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Description</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Amount</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($transactions as $transaction)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                            {{ $transaction->transaction_date ? $transaction->transaction_date->format('d M Y') : '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $transaction->type === 'income' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                {{ ucfirst($transaction->type) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                            @if($transaction->category)
                                <div class="flex items-center space-x-2">
                                    <span class="w-3 h-3 rounded-full" style="background-color: {{ $transaction->category->color }}"></span>
                                    <span>{{ $transaction->category->name }}</span>
                                </div>
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">
                            {{ $transaction->description ?? '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium {{ $transaction->type === 'income' ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                            Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <form action="{{ route('reports.destroy', $transaction->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this transaction?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 ml-4">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
            {{ $transactions->links() }}
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Chart.js instances holder
        let categoryStackedChart, expenseDistributionChart, incomeDistributionChart, categoryComparisonChart, monthlyTrendsChart, savingsRateChart;

        const chartColors = {
            income: 'rgba(75, 192, 192, 0.6)',
            expense: 'rgba(255, 99, 132, 0.6)',
            net: 'rgba(54, 162, 235, 0.6)',
        };

        function getDynamicColors(count) {
            const colors = [];
            const baseHue = 0; // Starting hue for color generation
            for (let i = 0; i < count; i++) {
                const hue = (baseHue + (i * 137)) % 360; // Use golden angle approximation for even distribution
                colors.push(`hsl(${hue}, 70%, 60%)`);
            }
            return colors;
        }

        function initializeCharts() {
            // Destroy existing chart instances if they exist
            if (categoryStackedChart) categoryStackedChart.destroy();
            if (expenseDistributionChart) expenseDistributionChart.destroy();
            if (incomeDistributionChart) incomeDistributionChart.destroy();
            if (categoryComparisonChart) categoryComparisonChart.destroy();
            if (monthlyTrendsChart) monthlyTrendsChart.destroy();
            if (savingsRateChart) savingsRateChart.destroy();

            // Income & Expenses by Category Stacked Bar Chart
            const categoryStackedCtx = document.getElementById('categoryStackedChart').getContext('2d');
            categoryStackedChart = new Chart(categoryStackedCtx, {
                type: 'bar',
                data: {
                    labels: @json($categoryComparison->pluck('category_name')),
                    datasets: [
                        {
                            label: 'Income',
                            data: @json($categoryComparison->pluck('income')),
                            backgroundColor: 'rgba(75, 192, 192, 0.8)',
                        },
                        {
                            label: 'Expenses',
                            data: @json($categoryComparison->pluck('expense')),
                            backgroundColor: 'rgba(255, 99, 132, 0.8)',
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            stacked: true,
                            grid: { display: false }
                        },
                        y: {
                            stacked: true,
                            beginAtZero: true,
                            grid: { color: 'rgba(200, 200, 200, 0.2)' }
                        }
                    },
                    plugins: {
                        legend: { display: true }
                    }
                }
            });

            // Expense Distribution Chart (Pie/Doughnut)
            const expenseCtx = document.getElementById('expenseDistributionChart').getContext('2d');
            const expenseLabels = @json($expenseCategories->pluck('category_name'));
            const expenseAmounts = @json($expenseCategories->pluck('amount'));
            const expenseColors = @json($expenseCategories->pluck('category_color'));
            expenseDistributionChart = new Chart(expenseCtx, {
                type: 'doughnut',
                data: {
                    labels: expenseLabels,
                    datasets: [{
                        data: expenseAmounts,
                        backgroundColor: expenseColors.length > 0 ? expenseColors : getDynamicColors(expenseLabels.length),
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                        },
                        title: {
                            display: true,
                            text: 'Expense Distribution'
                        }
                    }
                }
            });

            // Income Distribution Chart (Pie/Doughnut)
            const incomeCtx = document.getElementById('incomeDistributionChart').getContext('2d');
            const incomeLabels = @json($incomeCategories->pluck('category_name'));
            const incomeAmounts = @json($incomeCategories->pluck('amount'));
            const incomeColors = @json($incomeCategories->pluck('category_color'));
            incomeDistributionChart = new Chart(incomeCtx, {
                type: 'doughnut',
                data: {
                    labels: incomeLabels,
                    datasets: [{
                        data: incomeAmounts,
                        backgroundColor: incomeColors.length > 0 ? incomeColors : getDynamicColors(incomeLabels.length),
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                        },
                        title: {
                            display: true,
                            text: 'Income Distribution'
                        }
                    }
                }
            });

            // Category Comparison Chart
            const categoryComparisonCtx = document.getElementById('categoryComparisonChart').getContext('2d');
            categoryComparisonChart = new Chart(categoryComparisonCtx, {
                type: 'bar',
                data: {
                    labels: @json($categoryComparison->pluck('category_name')),
                    datasets: [
                        {
                            label: 'Income',
                            data: @json($categoryComparison->pluck('income')),
                            backgroundColor: 'rgba(75, 192, 192, 0.8)',
                        },
                        {
                            label: 'Expense',
                            data: @json($categoryComparison->pluck('expense')),
                            backgroundColor: 'rgba(255, 99, 132, 0.8)',
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: { stacked: false },
                        y: { stacked: false, beginAtZero: true }
                    },
                    plugins: {
                        legend: { display: true }
                    }
                }
            });

            // Monthly Trends Chart
            const monthlyTrendsCtx = document.getElementById('monthlyTrendsChart').getContext('2d');
            monthlyTrendsChart = new Chart(monthlyTrendsCtx, {
                type: 'line',
                data: {
                    labels: @json($monthlyTrends->pluck('month')),
                    datasets: [
                        {
                            label: 'Income',
                            data: @json($monthlyTrends->pluck('income')),
                            borderColor: 'rgb(75, 192, 192)',
                            backgroundColor: 'rgba(75, 192, 192, 0.5)',
                            fill: false,
                            tension: 0.1
                        },
                        {
                            label: 'Expense',
                            data: @json($monthlyTrends->pluck('expense')),
                            borderColor: 'rgb(255, 99, 132)',
                            backgroundColor: 'rgba(255, 99, 132, 0.5)',
                            fill: false,
                            tension: 0.1
                        },
                        {
                            label: 'Net',
                            data: @json($monthlyTrends->pluck('net')),
                            borderColor: 'rgb(54, 162, 235)',
                            backgroundColor: 'rgba(54, 162, 235, 0.5)',
                            fill: false,
                            tension: 0.1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: { grid: { display: false } },
                        y: { beginAtZero: true, grid: { color: 'rgba(200, 200, 200, 0.2)' } }
                    },
                    plugins: {
                        legend: { display: true }
                    }
                }
            });

            // Savings Rate Chart
            const savingsRateCtx = document.getElementById('savingsRateChart').getContext('2d');
            savingsRateChart = new Chart(savingsRateCtx, {
                type: 'line',
                data: {
                    labels: @json($savingsRateTrend->pluck('month')),
                    datasets: [{
                        label: 'Savings Rate (%)',
                        data: @json($savingsRateTrend->pluck('rate')),
                        borderColor: 'rgb(153, 102, 255)',
                        backgroundColor: 'rgba(153, 102, 255, 0.5)',
                        fill: false,
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: { grid: { display: false } },
                        y: {
                            beginAtZero: true,
                            max: 100,
                            ticks: { callback: function(value) { return value + '%'; } },
                            grid: { color: 'rgba(200, 200, 200, 0.2)' }
                        }
                    },
                    plugins: {
                        legend: { display: true }
                    }
                }
            });
        }

        initializeCharts();

        // Re-initialize charts on window focus (if user returns from category management)
        window.addEventListener('focus', initializeCharts);
    });
</script>
@endpush 