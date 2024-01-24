<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProjectLead;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = ['name','rollno','user_id','team_id'];

    public function team(){
        return $this->belongsTo(ProjectLead::class,'team_id');
    }
}

