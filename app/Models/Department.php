<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'manager_id'
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
    
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
}
