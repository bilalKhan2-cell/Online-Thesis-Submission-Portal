<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Department;
use App\Models\User;

class Supervisor extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'fname',
        'gender',
        'contact_info',
        'cnic',
        'address',
        'email_verified_at',
        'email',
        'user_id',
        'password',
        'department_id',
        "status"
    ];

    public function setNameAttribute($value){
        return $this->attributes['name'] = ucwords($value);
    }

    public function setFnameAttribute($value){
        return $this->attributes['fname'] = ucwords($value);
    }

    public function department(){
        return $this->belongsTo(Department::class,'department_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    protected $guard = "supervisor";
}
