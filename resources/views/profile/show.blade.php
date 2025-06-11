@extends('layouts.app')

@section('header', 'Profile')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
            <!-- Profile Header -->
            <div class="relative h-40 bg-gradient-to-r from-blue-500 to-indigo-600">
                <div class="absolute -bottom-16 left-8">
                    <div class="h-32 w-32 rounded-full border-4 border-white dark:border-gray-800 bg-white dark:bg-gray-800 flex items-center justify-center">
                        <i class="fas fa-user text-5xl text-gray-400"></i>
                    </div>
                </div>
                <div class="absolute bottom-4 right-8">
                    <span class="px-4 py-2 bg-white dark:bg-gray-800 text-blue-600 dark:text-blue-400 rounded-full text-sm font-semibold">
                        {{ ucfirst($user->role) }} Account
                    </span>
                </div>
            </div>

            <!-- Profile Content -->
            <div class="pt-20 pb-8 px-8">
                <div class="flex flex-col md:flex-row justify-between items-start mb-8 gap-4">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $user->name }}</h2>
                        <p class="text-gray-600 dark:text-gray-400 mt-1">{{ $user->email }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-500 mt-2">
                            Member since {{ $user->created_at->format('F j, Y') }}
                        </p>
                    </div>
                    <div class="flex gap-3">
                        <a href="{{ route('settings.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            <i class="fas fa-cog mr-2"></i>
                            Edit Profile
                        </a>
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-md hover:bg-gray-200 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                            <i class="fas fa-chart-line mr-2"></i>
                            View Dashboard
                        </a>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                    <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg">
                        <p class="text-sm text-blue-600 dark:text-blue-400">Total Transactions</p>
                        <p class="text-2xl font-bold text-blue-700 dark:text-blue-300">{{ $user->transactions_count ?? 0 }}</p>
                    </div>
                    <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg">
                        <p class="text-sm text-green-600 dark:text-green-400">Total Income</p>
                        <p class="text-2xl font-bold text-green-700 dark:text-green-300">
                            {{ number_format($user->transactions()->where('type', 'income')->sum('amount'), 2) }}
                        </p>
                    </div>
                    <div class="bg-red-50 dark:bg-red-900/20 p-4 rounded-lg">
                        <p class="text-sm text-red-600 dark:text-red-400">Total Expenses</p>
                        <p class="text-2xl font-bold text-red-700 dark:text-red-300">
                            {{ number_format($user->transactions()->where('type', 'expense')->sum('amount'), 2) }}
                        </p>
                    </div>
                    <div class="bg-purple-50 dark:bg-purple-900/20 p-4 rounded-lg">
                        <p class="text-sm text-purple-600 dark:text-purple-400">Net Balance</p>
                        <p class="text-2xl font-bold text-purple-700 dark:text-purple-300">
                            {{ number_format($user->transactions()->where('type', 'income')->sum('amount') - $user->transactions()->where('type', 'expense')->sum('amount'), 2) }}
                        </p>
                    </div>
                </div>

                <!-- User Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Business Information -->
                    <div class="space-y-6">
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                                <i class="fas fa-building mr-2 text-blue-500"></i>
                                Business Information
                            </h3>
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Business Name</p>
                                    <p class="text-gray-900 dark:text-white font-medium">{{ $user->business_name ?? 'Not set' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Business Type</p>
                                    <p class="text-gray-900 dark:text-white font-medium">{{ $user->business_type ?? 'Not set' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Business Address</p>
                                    <p class="text-gray-900 dark:text-white font-medium">{{ $user->business_address ?? 'Not set' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Business Phone</p>
                                    <p class="text-gray-900 dark:text-white font-medium">{{ $user->business_phone ?? 'Not set' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Account Information -->
                    <div class="space-y-6">
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                                <i class="fas fa-user-shield mr-2 text-blue-500"></i>
                                Account Information
                            </h3>
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Account Status</p>
                                    <p class="text-gray-900 dark:text-white font-medium">
                                        <span class="px-2 py-1 bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300 rounded-full text-xs">
                                            Active
                                        </span>
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Last Login</p>
                                    <p class="text-gray-900 dark:text-white font-medium">{{ $user->last_login_at?->format('F j, Y H:i') ?? 'Not available' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Last Updated</p>
                                    <p class="text-gray-900 dark:text-white font-medium">{{ $user->updated_at->format('F j, Y H:i') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Two-Factor Authentication</p>
                                    <p class="text-gray-900 dark:text-white font-medium">
                                        {{ $user->two_factor_enabled ? 'Enabled' : 'Disabled' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Preferences -->
                    <div class="space-y-6">
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                                <i class="fas fa-cog mr-2 text-blue-500"></i>
                                Preferences
                            </h3>
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Currency</p>
                                    <p class="text-gray-900 dark:text-white font-medium">{{ $user->currency ?? 'Not set' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Language</p>
                                    <p class="text-gray-900 dark:text-white font-medium">{{ $user->language ?? 'Not set' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Timezone</p>
                                    <p class="text-gray-900 dark:text-white font-medium">{{ $user->timezone ?? 'Not set' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Date Format</p>
                                    <p class="text-gray-900 dark:text-white font-medium">{{ $user->date_format ?? 'Not set' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="space-y-6">
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                                <i class="fas fa-history mr-2 text-blue-500"></i>
                                Recent Activity
                            </h3>
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Last Transaction</p>
                                    <p class="text-gray-900 dark:text-white font-medium">
                                        {{ $user->transactions()->latest()->first()?->created_at->format('F j, Y H:i') ?? 'No transactions yet' }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Last Article View</p>
                                    <p class="text-gray-900 dark:text-white font-medium">
                                        {{ $user->article_views()->latest()->first()?->created_at->format('F j, Y H:i') ?? 'No article views yet' }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Last Report Generated</p>
                                    <p class="text-gray-900 dark:text-white font-medium">
                                        {{ $user->reports()->latest()->first()?->created_at->format('F j, Y H:i') ?? 'No reports generated yet' }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Last Settings Update</p>
                                    <p class="text-gray-900 dark:text-white font-medium">
                                        {{ $user->settings()->latest()->first()?->updated_at->format('F j, Y H:i') ?? 'No settings updated yet' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 