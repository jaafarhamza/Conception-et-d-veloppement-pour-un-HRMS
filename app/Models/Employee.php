<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'company_id',
        'employee_number',
        'birth_date',
        'hire_date',
        'contract_type',
        'contract_start_date',
        'contract_end_date',
        'salary',
        'position'
    ];

    protected $dates = [
        'birth_date',
        'hire_date',
        'contract_start_date',
        'contract_end_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}