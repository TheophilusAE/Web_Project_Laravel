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
                            {{ ucfirst($transaction->category) }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">
                            {{ $transaction->description }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm {{ $transaction->type === 'income' ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                            Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <form action="{{ route('reports.destroy', $transaction) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300" onclick="return confirm('Are you sure you want to delete this transaction?')">
                                    <i class="fas fa-trash"></i>
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
<script>
    // Global variables to store chart instances
    let categoryStackedChart = null;
    let expenseDistributionChart = null;
    let incomeDistributionChart = null;
    let monthlyTrendsChart = null;
    let savingsRateChart = null;
    let chartsInitialized = false;

    function destroyAllCharts() {
        const charts = [
            categoryStackedChart,
            expenseDistributionChart,
            incomeDistributionChart,
            monthlyTrendsChart,
            savingsRateChart
        ];
        
        charts.forEach(chart => {
            if (chart) {
                chart.destroy();
            }
        });
        
        categoryStackedChart = null;
        expenseDistributionChart = null;
        incomeDistributionChart = null;
        monthlyTrendsChart = null;
        savingsRateChart = null;
        chartsInitialized = false;
    }

    function initializeCharts() {
        // Prevent multiple initializations
        if (chartsInitialized) {
            return;
        }

        // Destroy any existing charts first
        destroyAllCharts();

        const isDark = document.documentElement.classList.contains('dark');
        const themeColors = {
            background: isDark ? '#1f2937' : '#ffffff',
            text: isDark ? '#e5e7eb' : '#374151',
            border: isDark ? '#374151' : '#e5e7eb',
            grid: isDark ? '#374151' : '#e5e7eb',
            accent: isDark ? '#60a5fa' : '#3b82f6',
            accent2: isDark ? '#34d399' : '#10b981',
            accent3: isDark ? '#f87171' : '#ef4444',
            accent4: isDark ? '#fbbf24' : '#f59e0b',
            accent5: isDark ? '#a78bfa' : '#8b5cf6',
            accent6: isDark ? '#f472b6' : '#ec4899'
        };

        // Common chart options
        const commonOptions = {
            responsive: true,
            maintainAspectRatio: false,
            animation: false,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        color: themeColors.text,
                        boxWidth: 12,
                        padding: 15
                    }
                }
            }
        };

        try {
            // Category Stacked Chart
            const categoryStackedCtx = document.getElementById('categoryStackedChart')?.getContext('2d');
            if (categoryStackedCtx) {
                categoryStackedChart = new Chart(categoryStackedCtx, {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($categoryComparison->pluck('category')) !!},
                        datasets: [
                            {
                                label: 'Income',
                                data: {!! json_encode($categoryComparison->pluck('income')) !!},
                                backgroundColor: themeColors.accent,
                                borderColor: themeColors.accent,
                                borderWidth: 1
                            },
                            {
                                label: 'Expenses',
                                data: {!! json_encode($categoryComparison->pluck('expense')) !!},
                                backgroundColor: themeColors.accent3,
                                borderColor: themeColors.accent3,
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        ...commonOptions,
                        plugins: {
                            ...commonOptions.plugins,
                            title: {
                                display: true,
                                text: 'Income & Expenses by Category',
                                color: themeColors.text
                            }
                        },
                        scales: {
                            x: {
                                stacked: true,
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    color: themeColors.text,
                                    maxRotation: 45,
                                    minRotation: 45
                                }
                            },
                            y: {
                                stacked: true,
                                beginAtZero: true,
                                grid: {
                                    color: themeColors.grid
                                },
                                ticks: {
                                    color: themeColors.text
                                }
                            }
                        }
                    }
                });
            }

            // Expense Distribution Chart
            const expenseDistributionCtx = document.getElementById('expenseDistributionChart')?.getContext('2d');
            if (expenseDistributionCtx) {
                expenseDistributionChart = new Chart(expenseDistributionCtx, {
                    type: 'doughnut',
                    data: {
                        labels: {!! json_encode($expenseCategories->pluck('category')) !!},
                        datasets: [{
                            data: {!! json_encode($expenseCategories->pluck('amount')) !!},
                            backgroundColor: [
                                themeColors.accent,
                                themeColors.accent2,
                                themeColors.accent3,
                                themeColors.accent4,
                                themeColors.accent5,
                                themeColors.accent6
                            ],
                            borderColor: themeColors.background,
                            borderWidth: 2
                        }]
                    },
                    options: {
                        ...commonOptions,
                        plugins: {
                            ...commonOptions.plugins,
                            title: {
                                display: true,
                                text: 'Expense Distribution',
                                color: themeColors.text
                            }
                        },
                        cutout: '60%'
                    }
                });
            }

            // Income Distribution Chart
            const incomeDistributionCtx = document.getElementById('incomeDistributionChart')?.getContext('2d');
            if (incomeDistributionCtx) {
                incomeDistributionChart = new Chart(incomeDistributionCtx, {
                    type: 'doughnut',
                    data: {
                        labels: {!! json_encode($incomeCategories->pluck('category')) !!},
                        datasets: [{
                            data: {!! json_encode($incomeCategories->pluck('amount')) !!},
                            backgroundColor: [
                                themeColors.accent,
                                themeColors.accent2,
                                themeColors.accent3,
                                themeColors.accent4,
                                themeColors.accent5,
                                themeColors.accent6
                            ],
                            borderColor: themeColors.background,
                            borderWidth: 2
                        }]
                    },
                    options: {
                        ...commonOptions,
                        plugins: {
                            ...commonOptions.plugins,
                            title: {
                                display: true,
                                text: 'Income Distribution',
                                color: themeColors.text
                            }
                        },
                        cutout: '60%'
                    }
                });
            }

            // Monthly Trends Chart
            const monthlyTrendsCtx = document.getElementById('monthlyTrendsChart')?.getContext('2d');
            if (monthlyTrendsCtx) {
                monthlyTrendsChart = new Chart(monthlyTrendsCtx, {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($monthlyTrends->pluck('month')) !!},
                        datasets: [
                            {
                                label: 'Income',
                                data: {!! json_encode($monthlyTrends->pluck('income')) !!},
                                borderColor: themeColors.accent,
                                backgroundColor: themeColors.accent + '20',
                                fill: true,
                                tension: 0.4
                            },
                            {
                                label: 'Expenses',
                                data: {!! json_encode($monthlyTrends->pluck('expense')) !!},
                                borderColor: themeColors.accent3,
                                backgroundColor: themeColors.accent3 + '20',
                                fill: true,
                                tension: 0.4
                            },
                            {
                                label: 'Net',
                                data: {!! json_encode($monthlyTrends->pluck('net')) !!},
                                borderColor: themeColors.accent2,
                                backgroundColor: themeColors.accent2 + '20',
                                fill: true,
                                tension: 0.4
                            }
                        ]
                    },
                    options: {
                        ...commonOptions,
                        plugins: {
                            ...commonOptions.plugins,
                            title: {
                                display: true,
                                text: 'Monthly Trends',
                                color: themeColors.text
                            }
                        },
                        scales: {
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    color: themeColors.text
                                }
                            },
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: themeColors.grid
                                },
                                ticks: {
                                    color: themeColors.text
                                }
                            }
                        }
                    }
                });
            }

            // Savings Rate Chart
            const savingsRateCtx = document.getElementById('savingsRateChart')?.getContext('2d');
            if (savingsRateCtx) {
                savingsRateChart = new Chart(savingsRateCtx, {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($savingsRateTrend->pluck('month')) !!},
                        datasets: [{
                            label: 'Savings Rate (%)',
                            data: {!! json_encode($savingsRateTrend->pluck('rate')) !!},
                            borderColor: themeColors.accent2,
                            backgroundColor: themeColors.accent2 + '20',
                            fill: true,
                            tension: 0.4
                        }]
                    },
                    options: {
                        ...commonOptions,
                        plugins: {
                            ...commonOptions.plugins,
                            title: {
                                display: true,
                                text: 'Monthly Savings Rate',
                                color: themeColors.text
                            }
                        },
                        scales: {
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    color: themeColors.text
                                }
                            },
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: themeColors.grid
                                },
                                ticks: {
                                    color: themeColors.text,
                                    callback: function(value) {
                                        return value + '%';
                                    }
                                }
                            }
                        }
                    }
                });
            }

            chartsInitialized = true;
        } catch (error) {
            console.error('Error initializing charts:', error);
            destroyAllCharts();
        }
    }

    // Initialize charts when the DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initializeCharts);
    } else {
        initializeCharts();
    }

    // Update charts when theme changes
    document.addEventListener('themeChanged', function() {
        destroyAllCharts();
        initializeCharts();
    });

    // Cleanup charts when page is unloaded
    window.addEventListener('beforeunload', destroyAllCharts);

    // Update charts when page visibility changes
    document.addEventListener('visibilitychange', function() {
        if (document.visibilityState === 'visible') {
            destroyAllCharts();
            initializeCharts();
        }
    });
</script>
@endpush 