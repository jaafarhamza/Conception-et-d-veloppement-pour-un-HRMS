<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'birth_date',
        'address',
        'hire_date',
        'contract_type',
        'salary',
        'status',
        'department_id',
        'company_id',
        'user_id',
        'manager_id'
    ];

    protected $dates = [
        'birth_date',
        'hire_date'
    ];

    // Relationships

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function manager()
    {
        return $this->belongsTo(Employee::class, 'manager_id');
    }

    public function subordinates()
    {
        return $this->hasMany(Employee::class, 'manager_id');
    }

    public function leaves()
    {
        return $this->hasMany(Conge::class);
    }

    public function leaveBalance()
    {
        return $this->hasOne(CongeBalance::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('contracts')
            ->useDisk('contracts');
    }
}