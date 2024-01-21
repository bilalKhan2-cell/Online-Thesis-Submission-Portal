<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Department;
use App\Models\User;

class ProjectLead extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'fname',
        'gender',
        'rollno',
        'department_id',
        'user_id',
        'rollno',
        'email',
        'contact_info',
        'cnic',
        'project_id',
        'address',
        'status'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function setNameAttribute($value)
    {
        return $this->attributes['name'] = ucwords($value);
    }
}
