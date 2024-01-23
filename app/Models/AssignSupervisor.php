<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignSupervisor extends Model
{
    use HasFactory;

    protected $table = "thesis";

    protected $fillable = [
        'team_id',
        'supervisor_id',
        'thesis_title',
        'thesis_description',
        'marks',
        'is_edit_allowed',
        'is_marks_edit_allowed',
        'status',
    ];

    public function team(){
        return $this->belongsTo(ProjectLead::class,'team_id');
    }

    public function supervisor(){
        return $this->belongsTo(Supervisor::class,'supervisor_id');
    }

    public function user_data(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function setProjectTitleAttribute($value){
        return $this->attributes['project_title'] = ucwords($value);
    }

    public function projectLead(){
        return $this->belongsTo(ProjectLead::class, 'team_id');
    }
}
