<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;

class CompanyRegistrationController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.company-registration');
    }

    public function register(Request $request)
    {
        try {

            $validated = $request->validate([
                'company_name' => 'required|string|max:255',
                'business_sector' => 'required|string|max:255',
                'registration_number' => 'required|string|max:255|unique:companies',
                'company_email' => 'required|email|max:255|unique:companies,email',
                'company_phone' => 'required|string|max:20',
                'company_address' => 'required|string|max:500',
                'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'admin_first_name' => 'required|string|max:255',
                'admin_last_name' => 'required|string|max:255',
                'admin_email' => 'required|email|max:255|unique:users,email',
                'admin_phone' => 'required|string|max:20',
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            DB::beginTransaction();

            Log::info('Creating company...', ['company_name' => $request->company_name]);

            $company = Company::create([
                'name' => $request->company_name,
                'business_sector' => $request->business_sector,
                'registration_number' => $request->registration_number,
                'email' => $request->company_email,
                'phone' => $request->company_phone,
                'address' => $request->company_address,
                'is_active' => true
            ]);

            if (!$company) {
                throw new \Exception('Failed to create company');
            }

            Log::info('Creating admin user...', ['email' => $request->admin_email]);

            $admin = User::create([
                'company_id' => $company->id,
                'first_name' => $request->admin_first_name,
                'last_name' => $request->admin_last_name,
                'email' => $request->admin_email,
                'phone' => $request->admin_phone,
                'password' => Hash::make($request->password),
                'is_active' => true
            ]);

            if (!$admin) {
                throw new \Exception('Failed to create admin user');
            }

            Log::info('Assigning admin role...');
            $admin->assignRole('company-admin');

            if ($request->hasFile('company_logo')) {
                try {
                    $company->addMediaFromRequest('company_logo')
                        ->usingName($company->name . '_logo')
                        ->usingFileName($company->registration_number . '_logo.' . $request->file('company_logo')->extension())
                        ->toMediaCollection('logos');
                } catch (\Exception $e) {
                    Log::error('Failed to upload logo: ' . $e->getMessage());
                }
            }

            DB::commit();
            Log::info('Registration completed successfully');

            Auth::login($admin);
            return redirect()->route('dashboard')
                ->with('success', 'Company registered successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Registration failed', [
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);

            return back()
                ->withInput()
                ->with('error', 'Registration failed: ' . $e->getMessage());
        }
    }
}