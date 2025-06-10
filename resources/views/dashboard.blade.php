@extends('layouts.app')

@section('title', 'Dashboard - Finapp')

@section('header', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6" data-aos="fade-up">
        <!-- Total Balance Card -->
        <div class="card bg-gradient-to-br from-indigo-500 to-indigo-600 dark:from-indigo-600 dark:to-indigo-700 rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-white dark:text-white">Total Balance</h3>
                <i class="fas fa-wallet text-2xl opacity-75 text-white dark:text-white"></i>
            </div>
            <p class="text-3xl font-bold mb-2 text-white dark:text-white">Rp {{ number_format($totalBalance, 0, ',', '.') }}</p>
            <div class="flex items-center text-sm text-white dark:text-white">
                <span class="mr-2">Last 30 days</span>
                <i class="fas fa-arrow-trend-up text-green-300 dark:text-green-400"></i>
            </div>
        </div>

        <!-- Total Income Card -->
        <div class="card bg-gradient-to-br from-green-500 to-green-600 dark:from-green-600 dark:to-green-700 rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-white dark:text-white">Total Income</h3>
                <i class="fas fa-arrow-trend-up text-2xl opacity-75 text-white dark:text-white"></i>
            </div>
            <p class="text-3xl font-bold mb-2 text-white dark:text-white">Rp {{ number_format($totalIncome, 0, ',', '.') }}</p>
            <div class="flex items-center text-sm text-white dark:text-white">
                <span class="mr-2">This Month</span>
                <i class="fas fa-calendar text-green-300 dark:text-green-400"></i>
        </div>
    </div>

    <!-- Total Expenses Card -->
        <div class="card bg-gradient-to-br from-red-500 to-red-600 dark:from-red-600 dark:to-red-700 rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-white dark:text-white">Total Expenses</h3>
                <i class="fas fa-arrow-trend-down text-2xl opacity-75 text-white dark:text-white"></i>
            </div>
            <p class="text-3xl font-bold mb-2 text-white dark:text-white">Rp {{ number_format($totalExpenses, 0, ',', '.') }}</p>
            <div class="flex items-center text-sm text-white dark:text-white">
                <span class="mr-2">This Month</span>
                <i class="fas fa-calendar text-red-300 dark:text-red-400"></i>
            </div>
        </div>

        <!-- Savings Rate Card -->
        <div class="card bg-gradient-to-br from-purple-500 to-purple-600 dark:from-purple-600 dark:to-purple-700 rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-white dark:text-white">Savings Rate</h3>
                <i class="fas fa-piggy-bank text-2xl opacity-75 text-white dark:text-white"></i>
            </div>
            <p class="text-3xl font-bold mb-2 text-white dark:text-white">{{ number_format($savingsRate, 1) }}%</p>
            <div class="flex items-center text-sm text-white dark:text-white">
                <span class="mr-2">This Month</span>
                <i class="fas fa-chart-line text-purple-300 dark:text-purple-400"></i>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6" data-aos="fade-up" data-aos-delay="100">
        <!-- Monthly Trends Chart -->
        <div class="card bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    <i class="fas fa-chart-line text-indigo-500 mr-2"></i>
                    Monthly Trends
                </h3>
                <div class="flex items-center space-x-2">
                    <button class="px-3 py-1 text-sm font-medium rounded-full bg-indigo-100 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-200 hover:bg-indigo-200 dark:hover:bg-indigo-800 transition-colors">
                        6M
                    </button>
                    <button class="px-3 py-1 text-sm font-medium rounded-full bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                        1Y
                    </button>
                </div>
            </div>
            <div class="h-80">
                <canvas id="monthlyTrendsChart"></canvas>
        </div>
    </div>

        <!-- Category Distribution Chart -->
        <div class="card bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    <i class="fas fa-chart-pie text-indigo-500 mr-2"></i>
                    Category Distribution
                </h3>
                <select class="form-select bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg">
                    <option value="expenses">Expenses</option>
                    <option value="income">Income</option>
                </select>
            </div>
            <div class="h-80">
                <canvas id="categoryDistributionChart"></canvas>
        </div>
    </div>
</div>

<!-- Recent Transactions -->
    <div class="card bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden" data-aos="fade-up" data-aos-delay="200">
        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    <i class="fas fa-history text-indigo-500 mr-2"></i>
                    Recent Transactions
                </h3>
                <a href="{{ route('reports.index') }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 transition-colors">
            View All
        </a>
    </div>
        </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Type</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($recentTransactions as $transaction)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                            {{ $transaction->transaction_date ? $transaction->transaction_date->format('d M Y') : '-' }}
                                </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-medium rounded-full 
                                {{ $transaction->type === 'income' 
                                    ? 'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200' 
                                    : 'bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200' }}">
                                {{ $transaction->category }}
                                    </span>
                                </td>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">
                            {{ Str::limit($transaction->description, 50) }}
                                </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium 
                            {{ $transaction->type === 'income' 
                                ? 'text-green-600 dark:text-green-400' 
                                : 'text-red-600 dark:text-red-400' }}">
                                    Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            {{ ucfirst($transaction->type) }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                            No recent transactions found
                                </td>
                            </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
    </div>
</div>

@push('scripts')
<script>
    // Wait for theme.js to load and initialize
    function waitForThemeColors(callback) {
        if (typeof themeColors !== 'undefined') {
            callback();
        } else {
            setTimeout(() => waitForThemeColors(callback), 100);
        }
    }

    waitForThemeColors(function() {
        document.addEventListener('DOMContentLoaded', function() {
            // Monthly Trends Chart
            const monthlyTrendsCtx = document.getElementById('monthlyTrendsChart').getContext('2d');
            const monthlyTrendsChart = new Chart(monthlyTrendsCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode(array_keys($monthlyTrends)) !!},
                    datasets: [
                        {
                            label: 'Income',
                            data: {!! json_encode(array_column($monthlyTrends, 'income')) !!},
                            borderColor: themeColors[getCurrentTheme()].chart.income[0],
                            backgroundColor: themeColors[getCurrentTheme()].chart.income[0] + '20',
                            tension: 0.4,
                            fill: true
                        },
                        {
                            label: 'Expenses',
                            data: {!! json_encode(array_column($monthlyTrends, 'expense')) !!},
                            borderColor: themeColors[getCurrentTheme()].chart.expense[0],
                            backgroundColor: themeColors[getCurrentTheme()].chart.expense[0] + '20',
                            tension: 0.4,
                            fill: true
                        },
                        {
                            label: 'Net Balance',
                            data: {!! json_encode(array_column($monthlyTrends, 'net')) !!},
                            borderColor: themeColors[getCurrentTheme()].chart.accent[0],
                            backgroundColor: themeColors[getCurrentTheme()].chart.accent[0] + '20',
                            tension: 0.4,
                            fill: true
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                color: themeColors.text.primary,
                                usePointStyle: true,
                                padding: 20
                            }
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                            backgroundColor: themeColors.tooltip.background,
                            titleColor: themeColors.tooltip.title,
                            bodyColor: themeColors.tooltip.body,
                            borderColor: themeColors.tooltip.border,
                            borderWidth: 1,
                            padding: 12,
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed.y !== null) {
                                        label += new Intl.NumberFormat('id-ID', {
                                            style: 'currency',
                                            currency: 'IDR',
                                            minimumFractionDigits: 0,
                                            maximumFractionDigits: 0
                                        }).format(context.parsed.y);
                                    }
                                    return label;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                color: themeColors.grid,
                                drawBorder: false
                            },
                            ticks: {
                                color: themeColors.text.secondary,
                                maxRotation: 45,
                                minRotation: 45
                            }
                        },
                        y: {
                            grid: {
                                color: themeColors.grid,
                                drawBorder: false
                            },
                            ticks: {
                                color: themeColors.text.secondary,
                                callback: function(value) {
                                    return new Intl.NumberFormat('id-ID', {
                                        style: 'currency',
                                        currency: 'IDR',
                                        minimumFractionDigits: 0,
                                        maximumFractionDigits: 0,
                                        notation: 'compact',
                                        compactDisplay: 'short'
                                    }).format(value);
                                }
                            }
                        }
                    },
                    interaction: {
                        mode: 'nearest',
                        axis: 'x',
                        intersect: false
                    },
                    animation: {
                        duration: 750,
                        easing: 'easeInOutQuart'
                    }
                }
            });

            // Category Distribution Chart
            const categoryDistributionCtx = document.getElementById('categoryDistributionChart').getContext('2d');
            const categoryDistributionChart = new Chart(categoryDistributionCtx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode(array_keys($categoryDistribution)) !!},
                    datasets: [{
                        data: {!! json_encode(array_values($categoryDistribution)) !!},
                        backgroundColor: [
                            themeColors.chart.category1,
                            themeColors.chart.category2,
                            themeColors.chart.category3,
                            themeColors.chart.category4,
                            themeColors.chart.category5
                        ],
                        borderWidth: 2,
                        borderColor: themeColors.background.primary
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                color: themeColors.text.primary,
                                usePointStyle: true,
                                padding: 20,
                                font: {
                                    size: 12
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: themeColors.tooltip.background,
                            titleColor: themeColors.tooltip.title,
                            bodyColor: themeColors.tooltip.body,
                            borderColor: themeColors.tooltip.border,
                            borderWidth: 1,
                            padding: 12,
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.parsed || 0;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = Math.round((value / total) * 100);
                                    return `${label}: ${new Intl.NumberFormat('id-ID', {
                                        style: 'currency',
                                        currency: 'IDR',
                                        minimumFractionDigits: 0,
                                        maximumFractionDigits: 0
                                    }).format(value)} (${percentage}%)`;
                                }
                            }
                        }
                    },
                    cutout: '70%',
                    animation: {
                        duration: 750,
                        easing: 'easeInOutQuart'
                    }
                }
            });

            // Store chart instances for theme updates
            window.charts = {
                monthlyTrends: monthlyTrendsChart,
                categoryDistribution: categoryDistributionChart
            };

            // Period selector functionality
            const periodButtons = document.querySelectorAll('.card button');
            periodButtons.forEach(button => {
                button.addEventListener('click', () => {
                    periodButtons.forEach(btn => {
                        btn.classList.remove('bg-indigo-100', 'dark:bg-indigo-900', 'text-indigo-800', 'dark:text-indigo-200');
                        btn.classList.add('bg-gray-100', 'dark:bg-gray-700', 'text-gray-800', 'dark:text-gray-200');
                    });
                    button.classList.remove('bg-gray-100', 'dark:bg-gray-700', 'text-gray-800', 'dark:text-gray-200');
                    button.classList.add('bg-indigo-100', 'dark:bg-indigo-900', 'text-indigo-800', 'dark:text-indigo-200');
                    // Implement period change logic here
                });
            });

            // Category selector functionality
            const categorySelect = document.querySelector('select');
            categorySelect.addEventListener('change', (e) => {
                // Implement category change logic here
            });
        });
    });
</script>
@endpush
@endsection