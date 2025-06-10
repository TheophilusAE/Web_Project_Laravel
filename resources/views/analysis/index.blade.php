@extends('layouts.app')

@section('title', 'Financial Analysis - Finapp')

@section('header', 'Financial Analysis')

@section('content')
<div class="space-y-6">
    <!-- Analysis Type Toggle -->
    <div class="card bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6" data-aos="fade-up">
        <div class="flex justify-end space-x-4">
            <a href="{{ route('analysis.index', ['type' => 'monthly']) }}" 
               class="px-4 py-2 rounded-md transition-colors duration-150 {{ $analysisType === 'monthly' 
                    ? 'bg-gradient-to-r from-indigo-600 to-indigo-700 text-white shadow-md' 
                    : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                <i class="fas fa-calendar-alt mr-2"></i>
                Monthly
            </a>
            <a href="{{ route('analysis.index', ['type' => 'yearly']) }}"
               class="px-4 py-2 rounded-md transition-colors duration-150 {{ $analysisType === 'yearly' 
                    ? 'bg-gradient-to-r from-indigo-600 to-indigo-700 text-white shadow-md' 
                    : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                <i class="fas fa-calendar mr-2"></i>
                Yearly
            </a>
        </div>
    </div>

    <!-- Financial Metrics -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="card bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900 dark:to-green-800 rounded-lg shadow-lg p-6 transform hover:scale-105 transition-transform duration-200" data-aos="fade-up" data-aos-delay="100">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-gray-600 dark:text-gray-300 text-sm font-medium">Total Income</h3>
                    <p class="text-2xl font-bold text-green-600 dark:text-green-400 mt-2">
                        Rp {{ number_format($metrics['total_income'], 0, ',', '.') }}
                    </p>
                </div>
                <div class="w-12 h-12 rounded-full bg-green-100 dark:bg-green-800 flex items-center justify-center">
                    <i class="fas fa-arrow-up text-green-600 dark:text-green-400 text-xl"></i>
                </div>
            </div>
            @if(isset($metrics['income_change']))
            <div class="mt-4 flex items-center text-sm {{ $metrics['income_change'] >= 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                <i class="fas fa-{{ $metrics['income_change'] >= 0 ? 'arrow-up' : 'arrow-down' }} mr-1"></i>
                {{ abs($metrics['income_change']) }}% from last {{ $analysisType === 'monthly' ? 'month' : 'year' }}
            </div>
            @endif
        </div>

        <div class="card bg-gradient-to-br from-red-50 to-red-100 dark:from-red-900 dark:to-red-800 rounded-lg shadow-lg p-6 transform hover:scale-105 transition-transform duration-200" data-aos="fade-up" data-aos-delay="200">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-gray-600 dark:text-gray-300 text-sm font-medium">Total Expenses</h3>
                    <p class="text-2xl font-bold text-red-600 dark:text-red-400 mt-2">
                        Rp {{ number_format($metrics['total_expenses'], 0, ',', '.') }}
                    </p>
                </div>
                <div class="w-12 h-12 rounded-full bg-red-100 dark:bg-red-800 flex items-center justify-center">
                    <i class="fas fa-arrow-down text-red-600 dark:text-red-400 text-xl"></i>
                </div>
            </div>
            @if(isset($metrics['expense_change']))
            <div class="mt-4 flex items-center text-sm {{ $metrics['expense_change'] <= 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                <i class="fas fa-{{ $metrics['expense_change'] <= 0 ? 'arrow-down' : 'arrow-up' }} mr-1"></i>
                {{ abs($metrics['expense_change']) }}% from last {{ $analysisType === 'monthly' ? 'month' : 'year' }}
            </div>
            @endif
        </div>

        <div class="card bg-gradient-to-br {{ $metrics['net_income'] >= 0 ? 'from-emerald-50 to-emerald-100 dark:from-emerald-900 dark:to-emerald-800' : 'from-red-50 to-red-100 dark:from-red-900 dark:to-red-800' }} rounded-lg shadow-lg p-6 transform hover:scale-105 transition-transform duration-200" data-aos="fade-up" data-aos-delay="300">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-gray-600 dark:text-gray-300 text-sm font-medium">Net Income</h3>
                    <p class="text-2xl font-bold {{ $metrics['net_income'] >= 0 ? 'text-emerald-600 dark:text-emerald-400' : 'text-red-600 dark:text-red-400' }} mt-2">
                        Rp {{ number_format($metrics['net_income'], 0, ',', '.') }}
                    </p>
                </div>
                <div class="w-12 h-12 rounded-full {{ $metrics['net_income'] >= 0 ? 'bg-emerald-100 dark:bg-emerald-800' : 'bg-red-100 dark:bg-red-800' }} flex items-center justify-center">
                    <i class="fas fa-{{ $metrics['net_income'] >= 0 ? 'chart-line' : 'exclamation-triangle' }} {{ $metrics['net_income'] >= 0 ? 'text-emerald-600 dark:text-emerald-400' : 'text-red-600 dark:text-red-400' }} text-xl"></i>
                </div>
            </div>
            @if(isset($metrics['net_income_change']))
            <div class="mt-4 flex items-center text-sm {{ $metrics['net_income_change'] >= 0 ? 'text-emerald-600 dark:text-emerald-400' : 'text-red-600 dark:text-red-400' }}">
                <i class="fas fa-{{ $metrics['net_income_change'] >= 0 ? 'arrow-up' : 'arrow-down' }} mr-1"></i>
                {{ abs($metrics['net_income_change']) }}% from last {{ $analysisType === 'monthly' ? 'month' : 'year' }}
            </div>
            @endif
        </div>
    </div>

    <!-- Visualization: Key Financial Ratios Radar Chart -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center"><i class="fas fa-bullseye mr-2"></i>Key Financial Ratios</h2>
        <canvas id="ratiosRadarChart" class="w-full h-64"></canvas>
    </div>

    <!-- AI Analysis -->
    <div class="card bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6" data-aos="fade-up" data-aos-delay="400">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                <i class="fas fa-robot text-indigo-600 dark:text-indigo-400 mr-2"></i>
                AI Financial Analysis
            </h3>
            <span class="px-3 py-1 text-sm font-medium rounded-full bg-indigo-100 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-200">
                <i class="fas fa-bolt mr-1"></i>
                Powered by AI
            </span>
        </div>
        <div class="prose dark:prose-invert max-w-none">
            <p class="text-gray-700 dark:text-gray-300 leading-relaxed">{{ $analysis->analysis_summary }}</p>
            
            @if(!empty($analysis->recommendations))
            <div class="mt-8 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/50 dark:to-emerald-900/50 rounded-lg p-6">
                <h4 class="font-bold text-gray-900 dark:text-white flex items-center">
                    <i class="fas fa-lightbulb text-yellow-500 mr-2"></i>
                    Recommendations
                </h4>
                <ul class="mt-4 space-y-3">
                    @foreach($analysis->recommendations as $recommendation)
                    <li class="flex items-start bg-white dark:bg-gray-800 rounded-lg p-4 shadow-sm">
                        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-green-100 dark:bg-green-900 flex items-center justify-center mr-3">
                            <i class="fas fa-check text-green-600 dark:text-green-400"></i>
                        </div>
                        <span class="text-gray-700 dark:text-gray-300">{{ $recommendation }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if(!empty($analysis->related_resources))
            <div class="mt-8">
                <h4 class="font-bold text-gray-900 dark:text-white flex items-center">
                    <i class="fas fa-book text-indigo-500 mr-2"></i>
                    Related Resources
                </h4>
                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($analysis->related_resources as $resource)
                    <a href="{{ $resource['url'] }}" 
                       class="flex items-center p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                        <div class="flex-shrink-0 w-10 h-10 rounded-full {{ $resource['type'] === 'article' ? 'bg-blue-100 dark:bg-blue-900' : 'bg-purple-100 dark:bg-purple-900' }} flex items-center justify-center mr-4">
                            <i class="fas fa-{{ $resource['type'] === 'article' ? 'newspaper' : 'video' }} {{ $resource['type'] === 'article' ? 'text-blue-600 dark:text-blue-400' : 'text-purple-600 dark:text-purple-400' }}"></i>
                        </div>
                        <div>
                            <h5 class="font-medium text-gray-900 dark:text-white">{{ $resource['title'] }}</h5>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                {{ $resource['type'] === 'article' ? 'Article' : 'Video' }}
                            </p>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Category Distribution Chart -->
    <div class="card bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6" data-aos="fade-up" data-aos-delay="500">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                <i class="fas fa-chart-pie text-indigo-600 dark:text-indigo-400 mr-2"></i>
                Category Distribution
            </h3>
        </div>
        <div class="relative" style="height: 400px;">
            <canvas id="categoryChart"></canvas>
        </div>
    </div>

    <!-- Historical Analyses -->
    <div class="card bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6" data-aos="fade-up" data-aos-delay="600">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                <i class="fas fa-history text-indigo-600 dark:text-indigo-400 mr-2"></i>
                Historical Analyses
            </h3>
            <div class="flex items-center space-x-2">
                <select class="rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="all">All Time</option>
                    <option value="month">Last Month</option>
                    <option value="year">Last Year</option>
                </select>
            </div>
        </div>
        <div class="space-y-4">
            @foreach($historicalAnalyses as $historicalAnalysis)
            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-150">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <div class="flex items-center space-x-2">
                            <span class="px-2 py-1 text-xs font-medium rounded-full 
                                {{ $historicalAnalysis->analysis_type === 'monthly' 
                                    ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' 
                                    : 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200' }}">
                                <i class="fas fa-{{ $historicalAnalysis->analysis_type === 'monthly' ? 'calendar-alt' : 'calendar' }} mr-1"></i>
                                {{ ucfirst($historicalAnalysis->analysis_type) }}
                            </span>
                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                <i class="far fa-clock mr-1"></i>
                                {{ $historicalAnalysis->created_at->format('d M Y H:i') }}
                            </span>
                        </div>
                        <p class="mt-2 text-gray-700 dark:text-gray-300">{{ $historicalAnalysis->analysis_summary }}</p>
                    </div>
                    <button class="ml-4 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('categoryChart').getContext('2d');
    const categoryData = @json($categoryData);
    const metrics = @json($metrics);
    
    console.log('Financial Metrics received:', metrics);
    console.log('Radar Chart Data:', {
        cash_flow_ratio: metrics.cash_flow_ratio,
        operating_margin: metrics.operating_margin,
        growth_rate: metrics.growth_rate,
        profitability_index: metrics.profitability_index
    });
    
    // Check if dark mode is enabled
    const isDarkMode = document.documentElement.classList.contains('dark');
    
    // Configure chart colors based on theme
    const textColor = isDarkMode ? '#E5E7EB' : '#374151';
    const gridColor = isDarkMode ? '#374151' : '#E5E7EB';
    
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: categoryData.map(item => item.category),
            datasets: [{
                data: categoryData.map(item => item.amount),
                backgroundColor: [
                    '#4F46E5', // indigo-600
                    '#7C3AED', // violet-600
                    '#EC4899', // pink-600
                    '#F59E0B', // amber-500
                    '#10B981', // emerald-500
                    '#3B82F6', // blue-500
                    '#8B5CF6', // violet-500
                    '#EF4444', // red-500
                ],
                borderWidth: 2,
                borderColor: isDarkMode ? '#1F2937' : '#FFFFFF',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        color: textColor
                    }
                }
            }
        }
    });

    const ctxRatios = document.getElementById('ratiosRadarChart').getContext('2d');
    const ratiosRadarChart = new Chart(ctxRatios, {
        type: 'radar',
        data: {
            labels: ['Cash Flow', 'Operating Margin', 'Growth', 'Profitability'],
            datasets: [{
                label: 'Current Period',
                data: [
                    metrics.cash_flow_ratio ?? 0,
                    metrics.operating_margin ?? 0,
                    metrics.growth_rate ?? 0,
                    metrics.profitability_index ?? 0
                ],
                backgroundColor: isDarkMode ? 'rgba(79, 70, 229, 0.2)' : 'rgba(79, 70, 229, 0.2)',
                borderColor: '#4F46E5',
                pointBackgroundColor: '#4F46E5',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: '#4F46E5'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    labels: { color: textColor }
                },
                tooltip: {
                    backgroundColor: isDarkMode ? '#1F2937' : '#FFFFFF',
                    titleColor: textColor,
                    bodyColor: textColor,
                    borderColor: isDarkMode ? '#374151' : '#E5E7EB',
                    borderWidth: 1,
                    padding: 12
                }
            },
            scales: {
                r: {
                    angleLines: { color: gridColor },
                    grid: { color: gridColor },
                    pointLabels: { color: textColor },
                    ticks: { color: textColor, backdropColor: 'transparent' }
                }
            }
        }
    });
});
</script>
@endpush 