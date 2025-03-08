@extends('layouts.dashboard')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <!-- Welcome Section -->
    <div class="p-6 bg-gradient-to-r from-blue-500 to-indigo-600 text-white">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-semibold">Welcome back, {{ auth()->user()->first_name }}!</h1>
                <p class="mt-1 text-white/80">{{ now()->format('l, F j, Y') }}</p>
            </div>
            <div class="text-right">
                <p class="text-sm">Last Login</p>
                <p class="font-semibold">{{ now()->format('Y-m-d H:i:s') }}</p>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Employees Card -->
            <div class="bg-white rounded-lg shadow p-5 border border-gray-200">
                <div class="flex justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Total Employees</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $statistics['total_employees'] ?? 0 }}</p>
                    </div>
                    <div class="bg-blue-100 rounded-full p-3">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('employees.index') }}" class="text-sm text-blue-600 hover:text-blue-800">View all employees →</a>
                </div>
            </div>

            <!-- Departments Card -->
            <div class="bg-white rounded-lg shadow p-5 border border-gray-200">
                <div class="flex justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Departments</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $statistics['total_departments'] ?? 0 }}</p>
                    </div>
                    <div class="bg-green-100 rounded-full p-3">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('departments.index') }}" class="text-sm text-green-600 hover:text-green-800">Manage departments →</a>
                </div>
            </div>

            <!-- Documents Card -->
            <div class="bg-white rounded-lg shadow p-5 border border-gray-200">
                <div class="flex justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Documents</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $statistics['total_documents'] ?? 0 }}</p>
                    </div>
                    <div class="bg-yellow-100 rounded-full p-3">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('documents.index') }}" class="text-sm text-yellow-600 hover:text-yellow-800">View documents →</a>
                </div>
            </div>

            <!-- Company Info Card -->
            <div class="bg-white rounded-lg shadow p-5 border border-gray-200">
                <div class="flex justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Company</p>
                        <p class="text-xl font-bold text-gray-800 truncate">{{ auth()->user()->company->name }}</p>
                    </div>
                    <div class="bg-purple-100 rounded-full p-3">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="mt-8">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Quick Actions</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <a href="{{ route('employees.create') }}" class="flex items-center p-4 bg-white rounded-lg border border-gray-200 hover:bg-gray-50">
                    <div class="flex-shrink-0 bg-blue-500 rounded-full p-2">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-900">Add New Employee</p>
                        <p class="text-sm text-gray-500">Create a new employee record</p>
                    </div>
                </a>

                <a href="{{ route('departments.create') }}" class="flex items-center p-4 bg-white rounded-lg border border-gray-200 hover:bg-gray-50">
                    <div class="flex-shrink-0 bg-green-500 rounded-full p-2">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-900">Add Department</p>
                        <p class="text-sm text-gray-500">Create a new department</p>
                    </div>
                </a>

                <a href="{{ route('documents.create') }}" class="flex items-center p-4 bg-white rounded-lg border border-gray-200 hover:bg-gray-50">
                    <div class="flex-shrink-0 bg-yellow-500 rounded-full p-2">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-900">Upload Document</p>
                        <p class="text-sm text-gray-500">Add a new document</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="mt-8">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Recent Activity</h2>
            <div class="bg-white rounded-lg border border-gray-200">
                <div class="p-4">
                    <div class="space-y-4">
                        <p class="text-sm text-gray-500">No recent activity to display.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection