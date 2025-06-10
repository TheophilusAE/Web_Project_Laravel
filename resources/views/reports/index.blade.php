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
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center"><i class="fas fa-layer-group mr-2"></i>Income & Expenses by Category</h2>
        <canvas id="categoryStackedChart" class="w-full h-64"></canvas>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Expense Distribution Chart -->
        <div class="card bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6" data-aos="fade-up" data-aos-delay="100">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    <i class="fas fa-chart-pie text-red-500 mr-2"></i>
                    Expense Distribution
                </h3>
                <div class="flex items-center space-x-2">
                    <select id="expenseChartPeriod" 
                            class="text-sm rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="month">This Month</option>
                        <option value="year">This Year</option>
                    </select>
                </div>
            </div>
            <div class="relative" style="height: 300px;">
                <canvas id="expenseDistributionChart"></canvas>
            </div>
        </div>

        <!-- Income Distribution Chart -->
        <div class="card bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6" data-aos="fade-up" data-aos-delay="200">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    <i class="fas fa-chart-pie text-green-500 mr-2"></i>
                    Income Distribution
                </h3>
                <div class="flex items-center space-x-2">
                    <select id="incomeChartPeriod" 
                            class="text-sm rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="month">This Month</option>
                        <option value="year">This Year</option>
                    </select>
                </div>
            </div>
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
    <div class="card bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6" data-aos="fade-up" data-aos-delay="400">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                <i class="fas fa-chart-line text-indigo-500 mr-2"></i>
                Monthly Trends
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
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 rounded-full bg-blue-500"></div>
                    <span class="text-sm text-gray-600 dark:text-gray-400">Net</span>
                </div>
            </div>
        </div>
        <div class="relative" style="height: 400px;">
            <canvas id="monthlyTrendsChart"></canvas>
        </div>
    </div>

    <!-- Savings Rate Chart -->
    <div class="card bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6" data-aos="fade-up" data-aos-delay="500">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                <i class="fas fa-chart-area text-purple-500 mr-2"></i>
                Savings Rate Trend
            </h3>
            <div class="flex items-center space-x-2">
                <select id="savingsChartPeriod" 
                        class="text-sm rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="6">Last 6 Months</option>
                    <option value="12">Last 12 Months</option>
                </select>
            </div>
        </div>
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

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Enhanced theme color configuration
const themeColors = {
    light: {
        // Base colors
        text: {
            primary: '#1F2937',
            secondary: '#4B5563',
            muted: '#6B7280',
            inverse: '#FFFFFF'
        },
        background: {
            primary: '#FFFFFF',
            secondary: '#F9FAFB',
            card: '#FFFFFF',
            gradient: {
                start: 'rgba(255, 255, 255, 0.9)',
                end: 'rgba(255, 255, 255, 0.7)'
            }
        },
        border: {
            light: '#E5E7EB',
            medium: '#D1D5DB',
            dark: '#9CA3AF'
        },
        grid: {
            primary: '#E5E7EB',
            secondary: '#F3F4F6'
        },
        chart: {
            income: ['#059669', '#10B981', '#34D399', '#6EE7B7', '#A7F3D0'],
            expense: ['#DC2626', '#EF4444', '#F87171', '#FCA5A5', '#FECACA'],
            neutral: ['#6B7280', '#9CA3AF', '#D1D5DB', '#E5E7EB', '#F3F4F6'],
            accent: ['#3B82F6', '#60A5FA', '#93C5FD', '#BFDBFE', '#DBEAFE']
        },
        tooltip: {
            background: '#FFFFFF',
            border: '#E5E7EB',
            text: '#1F2937'
        },
        shadow: {
            sm: '0 1px 2px 0 rgba(0, 0, 0, 0.05)',
            md: '0 4px 6px -1px rgba(0, 0, 0, 0.1)',
            lg: '0 10px 15px -3px rgba(0, 0, 0, 0.1)'
        }
    },
    dark: {
        // Base colors
        text: {
            primary: '#F9FAFB',
            secondary: '#E5E7EB',
            muted: '#9CA3AF',
            inverse: '#1F2937'
        },
        background: {
            primary: '#111827',
            secondary: '#1F2937',
            card: '#1F2937',
            gradient: {
                start: 'rgba(17, 24, 39, 0.9)',
                end: 'rgba(17, 24, 39, 0.7)'
            }
        },
        border: {
            light: '#374151',
            medium: '#4B5563',
            dark: '#6B7280'
        },
        grid: {
            primary: '#374151',
            secondary: '#1F2937'
        },
        chart: {
            income: ['#059669', '#10B981', '#34D399', '#6EE7B7', '#A7F3D0'],
            expense: ['#DC2626', '#EF4444', '#F87171', '#FCA5A5', '#FECACA'],
            neutral: ['#9CA3AF', '#6B7280', '#4B5563', '#374151', '#1F2937'],
            accent: ['#60A5FA', '#3B82F6', '#2563EB', '#1D4ED8', '#1E40AF']
        },
        tooltip: {
            background: '#1F2937',
            border: '#374151',
            text: '#F9FAFB'
        },
        shadow: {
            sm: '0 1px 2px 0 rgba(0, 0, 0, 0.3)',
            md: '0 4px 6px -1px rgba(0, 0, 0, 0.4)',
            lg: '0 10px 15px -3px rgba(0, 0, 0, 0.4)'
        }
    }
};

// Chart instances storage
let charts = {
    expense: null,
    income: null,
    category: null,
    trends: null,
    savings: null
};

// Function to get current theme
function getCurrentTheme() {
    return document.documentElement.classList.contains('dark') ? 'dark' : 'light';
}

// Function to apply theme to elements
function applyThemeToElements() {
    const theme = getCurrentTheme();
    const colors = themeColors[theme];

    // Update card styles
    document.querySelectorAll('.card').forEach(card => {
        if (!card.classList.contains('bg-gradient-to-br')) {
            card.style.backgroundColor = colors.background.card;
            card.style.boxShadow = colors.shadow.md;
            card.style.borderColor = colors.border.light;
        }
    });

    // Update text colors
    document.querySelectorAll('[class*="text-gray-"]').forEach(element => {
        const classes = element.className.split(' ');
        classes.forEach(cls => {
            if (cls.startsWith('text-gray-')) {
                element.classList.remove(cls);
            }
        });
        if (element.classList.contains('font-bold')) {
            element.style.color = colors.text.primary;
        } else if (element.classList.contains('text-sm')) {
            element.style.color = colors.text.secondary;
        } else {
            element.style.color = colors.text.muted;
        }
    });

    // Update icons
    document.querySelectorAll('.fas, .far, .fab').forEach(icon => {
        const parentCard = icon.closest('.card');
        if (parentCard) {
            if (parentCard.classList.contains('bg-gradient-to-br')) {
                // Keep gradient card icons as is
                return;
            }
            if (icon.classList.contains('text-red-')) {
                icon.style.color = colors.chart.expense[0];
            } else if (icon.classList.contains('text-green-')) {
                icon.style.color = colors.chart.income[0];
            } else if (icon.classList.contains('text-blue-')) {
                icon.style.color = colors.chart.accent[0];
            } else {
                icon.style.color = colors.text.secondary;
            }
        }
    });

    // Update buttons
    document.querySelectorAll('button').forEach(button => {
        if (!button.classList.contains('bg-indigo-')) {
            button.style.borderColor = colors.border.medium;
            button.style.color = colors.text.primary;
            button.style.backgroundColor = colors.background.secondary;
        }
    });

    // Update select elements
    document.querySelectorAll('select').forEach(select => {
        select.style.backgroundColor = colors.background.secondary;
        select.style.borderColor = colors.border.medium;
        select.style.color = colors.text.primary;
    });
}

// Function to update chart colors
function updateChartColors() {
    const theme = getCurrentTheme();
    const colors = themeColors[theme];
    
    // Update common options
    const commonOptions = {
        responsive: true,
        maintainAspectRatio: false,
        animation: {
            duration: 750,
            easing: 'easeInOutQuart'
        },
        plugins: {
            legend: {
                labels: {
                    color: colors.text.primary,
                    font: {
                        size: 12,
                        family: "'Inter', sans-serif"
                    },
                    padding: 20,
                    usePointStyle: true,
                    pointStyle: 'circle'
                }
            },
            tooltip: {
                backgroundColor: colors.tooltip.background,
                titleColor: colors.tooltip.text,
                bodyColor: colors.tooltip.text,
                borderColor: colors.tooltip.border,
                borderWidth: 1,
                padding: 12,
                cornerRadius: 8,
                displayColors: true,
                usePointStyle: true,
                callbacks: {
                    label: function(context) {
                        const label = context.label || '';
                        const value = context.raw || 0;
                        const prefix = context.dataset.type === 'percentage' ? '' : 'Rp ';
                        const suffix = context.dataset.type === 'percentage' ? '%' : '';
                        return `${label}: ${prefix}${value.toLocaleString('id-ID')}${suffix}`;
                    }
                }
            }
        }
    };

    // Update each chart
    Object.values(charts).forEach(chart => {
        if (chart) {
            // Update chart options
            chart.options.plugins.legend.labels.color = colors.text.primary;
            chart.options.plugins.tooltip.backgroundColor = colors.tooltip.background;
            chart.options.plugins.tooltip.titleColor = colors.tooltip.text;
            chart.options.plugins.tooltip.bodyColor = colors.tooltip.text;
            chart.options.plugins.tooltip.borderColor = colors.tooltip.border;

            // Update scales if they exist
            if (chart.options.scales) {
                if (chart.options.scales.x) {
                    chart.options.scales.x.grid.color = colors.grid.primary;
                    chart.options.scales.x.grid.borderColor = colors.grid.primary;
                    chart.options.scales.x.ticks.color = colors.text.secondary;
                    chart.options.scales.x.border.color = colors.border.light;
                }
                if (chart.options.scales.y) {
                    chart.options.scales.y.grid.color = colors.grid.primary;
                    chart.options.scales.y.grid.borderColor = colors.grid.primary;
                    chart.options.scales.y.ticks.color = colors.text.secondary;
                    chart.options.scales.y.border.color = colors.border.light;
                }
            }

            // Update dataset colors based on chart type
            if (chart.config.type === 'doughnut') {
                chart.data.datasets.forEach(dataset => {
                    dataset.borderColor = colors.background.primary;
                    dataset.backgroundColor = dataset.label.toLowerCase().includes('income') 
                        ? colors.chart.income 
                        : colors.chart.expense;
                });
            } else if (chart.config.type === 'bar') {
                chart.data.datasets.forEach(dataset => {
                    dataset.backgroundColor = dataset.label.toLowerCase().includes('income')
                        ? colors.chart.income[0]
                        : colors.chart.expense[0];
                    dataset.borderColor = colors.background.primary;
                });
            } else if (chart.config.type === 'line') {
                chart.data.datasets.forEach(dataset => {
                    const colorIndex = dataset.label.toLowerCase().includes('income') ? 0 : 1;
                    dataset.borderColor = dataset.label.toLowerCase().includes('savings')
                        ? colors.chart.accent[colorIndex]
                        : dataset.label.toLowerCase().includes('income')
                            ? colors.chart.income[colorIndex]
                            : colors.chart.expense[colorIndex];
                    dataset.backgroundColor = dataset.borderColor + '20'; // Add transparency
                });
            }

            chart.update('none'); // Update without animation for theme changes
        }
    });

    // Apply theme to other elements
    applyThemeToElements();
}

// Initialize charts with enhanced options
document.addEventListener('DOMContentLoaded', function() {
    const theme = getCurrentTheme();
    const colors = themeColors[theme];
    
    // Common chart options
    const commonOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                labels: {
                    color: colors.text.primary,
                    font: {
                        size: 12
                    }
                }
            },
            tooltip: {
                backgroundColor: colors.tooltip.background,
                titleColor: colors.tooltip.text,
                bodyColor: colors.tooltip.text,
                borderColor: colors.tooltip.border,
                borderWidth: 1,
                padding: 12,
                callbacks: {
                    label: function(context) {
                        const label = context.label || '';
                        const value = context.raw || 0;
                        return `${label}: Rp ${value.toLocaleString('id-ID')}`;
                    }
                }
            }
        }
    };

    // Initialize chart contexts
    const expenseCtx = document.getElementById('expenseDistributionChart').getContext('2d');
    const incomeCtx = document.getElementById('incomeDistributionChart').getContext('2d');
    const categoryCtx = document.getElementById('categoryComparisonChart').getContext('2d');
    const trendsCtx = document.getElementById('monthlyTrendsChart').getContext('2d');
    const savingsCtx = document.getElementById('savingsRateChart').getContext('2d');

    // Get unique categories
    const categories = {!! json_encode($transactions->pluck('category')->unique()) !!};
    
    // Prepare data for category comparison
    const categoryData = categories.map(category => {
        const income = {!! json_encode($transactions->where('type', 'income')->where('category', 'PLACEHOLDER')->sum('amount')) !!}.replace('PLACEHOLDER', category);
        const expense = {!! json_encode($transactions->where('type', 'expense')->where('category', 'PLACEHOLDER')->sum('amount')) !!}.replace('PLACEHOLDER', category);
        return { category, income: parseFloat(income), expense: parseFloat(expense) };
    });

    // Initialize all charts
    charts.expense = new Chart(expenseCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($transactions->where('type', 'expense')->pluck('category')->unique()) !!},
            datasets: [{
                data: {!! json_encode($transactions->where('type', 'expense')->groupBy('category')->map(function($group) {
                    return $group->sum('amount');
                })) !!},
                backgroundColor: [
                    '#EF4444', // red-500
                    '#F97316', // orange-500
                    '#F59E0B', // amber-500
                    '#EC4899', // pink-600
                    '#8B5CF6', // violet-500
                    '#6366F1', // indigo-500
                    '#3B82F6', // blue-500
                ],
                borderWidth: 2,
                borderColor: colors.background.primary,
            }]
        },
        options: {
            ...commonOptions,
            cutout: '70%',
            plugins: {
                ...commonOptions.plugins,
                legend: {
                    ...commonOptions.plugins.legend,
                    position: 'right'
                }
            }
        }
    });

    charts.income = new Chart(incomeCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($transactions->where('type', 'income')->pluck('category')->unique()) !!},
            datasets: [{
                data: {!! json_encode($transactions->where('type', 'income')->groupBy('category')->map(function($group) {
                    return $group->sum('amount');
                })) !!},
                backgroundColor: [
                    '#10B981', // emerald-500
                    '#059669', // emerald-600
                    '#34D399', // emerald-400
                    '#6EE7B7', // emerald-300
                    '#A7F3D0', // emerald-200
                    '#D1FAE5', // emerald-100
                ],
                borderWidth: 2,
                borderColor: colors.background.primary,
            }]
        },
        options: {
            ...commonOptions,
            cutout: '70%',
            plugins: {
                ...commonOptions.plugins,
                legend: {
                    ...commonOptions.plugins.legend,
                    position: 'right'
                }
            }
        }
    });

    charts.category = new Chart(categoryCtx, {
        type: 'bar',
        data: {
            labels: categoryData.map(d => d.category),
            datasets: [
                {
                    label: 'Income',
                    data: categoryData.map(d => d.income),
                    backgroundColor: '#10B981',
                    borderRadius: 4,
                },
                {
                    label: 'Expenses',
                    data: categoryData.map(d => d.expense),
                    backgroundColor: '#EF4444',
                    borderRadius: 4,
                }
            ]
        },
        options: {
            ...commonOptions,
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: colors.text.primary
                    }
                },
                y: {
                    grid: {
                        color: colors.grid.primary,
                        borderColor: colors.grid.primary
                    },
                    ticks: {
                        color: colors.text.secondary,
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            }
        }
    });

    charts.trends = new Chart(trendsCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($transactions->pluck('transaction_date')->map(function($date) {
                return $date->format('M Y');
            })->unique()->values()) !!},
            datasets: [
                {
                    label: 'Income',
                    data: {!! json_encode($transactions->where('type', 'income')->groupBy(function($date) {
                        return $date->transaction_date->format('M Y');
                    })->map(function($group) {
                        return $group->sum('amount');
                    })) !!},
                    borderColor: '#10B981',
                    backgroundColor: '#10B98120',
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'Expenses',
                    data: {!! json_encode($transactions->where('type', 'expense')->groupBy(function($date) {
                        return $date->transaction_date->format('M Y');
                    })->map(function($group) {
                        return $group->sum('amount');
                    })) !!},
                    borderColor: '#EF4444',
                    backgroundColor: '#EF444420',
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'Net',
                    data: {!! json_encode($transactions->groupBy(function($date) {
                        return $date->transaction_date->format('M Y');
                    })->map(function($group) {
                        return $group->where('type', 'income')->sum('amount') - $group->where('type', 'expense')->sum('amount');
                    })) !!},
                    borderColor: '#3B82F6',
                    backgroundColor: '#3B82F620',
                    tension: 0.4,
                    fill: true
                }
            ]
        },
        options: {
            ...commonOptions,
            scales: {
                x: {
                    grid: {
                        color: colors.grid.primary,
                        borderColor: colors.grid.primary
                    },
                    ticks: {
                        color: colors.text.primary
                    }
                },
                y: {
                    grid: {
                        color: colors.grid.primary,
                        borderColor: colors.grid.primary
                    },
                    ticks: {
                        color: colors.text.secondary,
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            }
        }
    });

    charts.savings = new Chart(savingsCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($transactions->pluck('transaction_date')->map(function($date) {
                return $date->format('M Y');
            })->unique()->values()) !!},
            datasets: [{
                label: 'Savings Rate',
                data: {!! json_encode($transactions->groupBy(function($date) {
                    return $date->transaction_date->format('M Y');
                })->map(function($group) {
                    $income = $group->where('type', 'income')->sum('amount');
                    $expense = $group->where('type', 'expense')->sum('amount');
                    return $income > 0 ? (($income - $expense) / $income) * 100 : 0;
                })) !!},
                borderColor: '#8B5CF6',
                backgroundColor: '#8B5CF620',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            ...commonOptions,
            scales: {
                x: {
                    grid: {
                        color: colors.grid.primary,
                        borderColor: colors.grid.primary
                    },
                    ticks: {
                        color: colors.text.primary
                    }
                },
                y: {
                    grid: {
                        color: colors.grid.primary,
                        borderColor: colors.grid.primary
                    },
                    ticks: {
                        color: colors.text.secondary,
                        callback: function(value) {
                            return value + '%';
                        }
                    }
                }
            }
        }
    });

    // Listen for theme changes with debounce
    let themeChangeTimeout;
    const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
            if (mutation.attributeName === 'class') {
                clearTimeout(themeChangeTimeout);
                themeChangeTimeout = setTimeout(() => {
                    updateChartColors();
                }, 100); // Debounce theme changes
            }
        });
    });

    observer.observe(document.documentElement, {
        attributes: true,
        attributeFilter: ['class']
    });

    // Initial theme application
    updateChartColors();

    // Handle period changes
    document.getElementById('expenseChartPeriod').addEventListener('change', function(e) {
        console.log('Expense chart period changed to:', e.target.value);
    });

    document.getElementById('incomeChartPeriod').addEventListener('change', function(e) {
        console.log('Income chart period changed to:', e.target.value);
    });

    document.getElementById('savingsChartPeriod').addEventListener('change', function(e) {
        console.log('Savings chart period changed to:', e.target.value);
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('categoryStackedChart').getContext('2d');
    const categoryStackedChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($categorySummary->pluck('category')->unique()) !!},
            datasets: [
                {
                    label: 'Income',
                    data: {!! json_encode($categorySummary->where('type', 'income')->pluck('total')) !!},
                    backgroundColor: themeColors.chart.income,
                },
                {
                    label: 'Expense',
                    data: {!! json_encode($categorySummary->where('type', 'expense')->pluck('total')) !!},
                    backgroundColor: themeColors.chart.expenses,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    labels: { color: themeColors.text.primary }
                },
                tooltip: {
                    backgroundColor: themeColors.tooltip.background,
                    titleColor: themeColors.tooltip.title,
                    bodyColor: themeColors.tooltip.body,
                    borderColor: themeColors.tooltip.border,
                    borderWidth: 1,
                    padding: 12
                }
            },
            scales: {
                x: {
                    stacked: true,
                    grid: { color: themeColors.grid },
                    ticks: { color: themeColors.text.secondary }
                },
                y: {
                    stacked: true,
                    grid: { color: themeColors.grid },
                    ticks: { color: themeColors.text.secondary }
                }
            }
        }
    });
});
</script>
@endpush
@endsection 