<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $company = Auth::user()->company;
        
        $statistics = [
            'total_employees' => Employee::where('company_id', $company->id)->count(),
            'total_departments' => Department::where('company_id', $company->id)->count(),
            'total_documents' => Document::where('company_id', $company->id)->count(),
        ];

        return view('dashboard.index', compact('statistics'));
    }
}