@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-900">Employee Details</h1>
            <div class="flex space-x-4">
                <a href="{{ route('employees.edit', $employee) }}" 
                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Edit Employee
                </a>
                <a href="{{ route('employees.index') }}" 
                   class="text-blue-600 hover:text-blue-900">← Back to Employees</a>
            </div>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <!-- Personal Information -->
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Personal Information</h3>
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Full name</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">
                            {{ $employee->user->first_name }} {{ $employee->user->last_name }}
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Employee number</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $employee->employee_number }}</dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Email address</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $employee->user->email }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Phone number</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $employee->user->phone ?? 'N/A' }}</dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Birth date</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">
                            {{ $employee->birth_date->format('F j, Y') }}
                        </dd>
                    </div>
                </dl>
            </div>

            <!-- Employment Information -->
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Employment Information</h3>
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Position</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $employee->position }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Hire date</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">
                            {{ $employee->hire_date->format('F j, Y') }}
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Contract type</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $employee->contract_type === 'CDI' ? 'bg-green-100 text-green-800' : 
                                   ($employee->contract_type === 'CDD' ? 'bg-yellow-100 text-yellow-800' : 
                                    'bg-blue-100 text-blue-800') }}">
                                {{ $employee->contract_type }}
                            </span>
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Contract period</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">
                            {{ $employee->contract_start_date->format('F j, Y') }} - 
                            {{ $employee->contract_end_date ? $employee->contract_end_date->format('F j, Y') : 'Ongoing' }}
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Salary</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">
                            {{ number_format($employee->salary, 2) }} MAD
                        </dd>
                    </div>
                </dl>
            </div>

            <!-- Additional Actions -->
            <div class="px-4 py-5 sm:px-6">
                <div class="flex justify-end space-x-3">
                    <form action="{{ route('employees.destroy', $employee) }}" 
                          method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this employee?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Delete Employee
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection