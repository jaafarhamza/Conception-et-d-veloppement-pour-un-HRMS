<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with(['user'])
            ->where('company_id', Auth::user()->company_id)
            ->paginate(10);

        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:255',
            'employee_number' => 'required|string|unique:employees',
            'birth_date' => 'required|date',
            'hire_date' => 'required|date',
            'contract_type' => ['required', Rule::in(['CDI', 'CDD', 'Stage', 'Freelance'])],
            'contract_start_date' => 'required|date',
            'contract_end_date' => 'nullable|date|after:contract_start_date',
            'salary' => 'required|numeric|min:0',
            'position' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            DB::beginTransaction();

            // Create User
            $user = User::create([
                'company_id' => Auth::user()->company_id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);

            // Create Employee
            Employee::create([
                'user_id' => $user->id,
                'company_id' => Auth::user()->company_id,
                'employee_number' => $request->employee_number,
                'birth_date' => $request->birth_date,
                'hire_date' => $request->hire_date,
                'contract_type' => $request->contract_type,
                'contract_start_date' => $request->contract_start_date,
                'contract_end_date' => $request->contract_end_date,
                'salary' => $request->salary,
                'position' => $request->position,
            ]);

            DB::commit();

            return redirect()->route('employees.index')
                ->with('success', 'Employee created successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Error creating employee: ' . $e->getMessage());
        }
    }

    public function show(Employee $employee)
    {
        if ($employee->company_id !== Auth::user()->company_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        if ($employee->company_id !== Auth::user()->company_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        if ($employee->company_id !== Auth::user()->company_id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($employee->user_id)],
            'phone' => 'nullable|string|max:255',
            'employee_number' => ['required', 'string', Rule::unique('employees')->ignore($employee->id)],
            'birth_date' => 'required|date',
            'hire_date' => 'required|date',
            'contract_type' => ['required', Rule::in(['CDI', 'CDD', 'Stage', 'Freelance'])],
            'contract_start_date' => 'required|date',
            'contract_end_date' => 'nullable|date|after:contract_start_date',
            'salary' => 'required|numeric|min:0',
            'position' => 'required|string|max:255',
        ]);

        try {
            DB::beginTransaction();

            // Update User
            $employee->user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

            // Update Employee
            $employee->update([
                'employee_number' => $request->employee_number,
                'birth_date' => $request->birth_date,
                'hire_date' => $request->hire_date,
                'contract_type' => $request->contract_type,
                'contract_start_date' => $request->contract_start_date,
                'contract_end_date' => $request->contract_end_date,
                'salary' => $request->salary,
                'position' => $request->position,
            ]);

            DB::commit();

            return redirect()->route('employees.index')
                ->with('success', 'Employee updated successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Error updating employee: ' . $e->getMessage());
        }
    }

    public function destroy(Employee $employee)
    {
        if ($employee->company_id !== Auth::user()->company_id) {
            abort(403, 'Unauthorized action.');
        }

        try {
            DB::beginTransaction();

            $employee->delete();
            $employee->user->delete();

            DB::commit();

            return redirect()->route('employees.index')
                ->with('success', 'Employee deleted successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error deleting employee: ' . $e->getMessage());
        }
    }
}