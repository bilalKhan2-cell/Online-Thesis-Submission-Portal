<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    public function get_members_by_team_id(Request $request)
    {
        return response()->json(['members' => TeamMember::where('team_id', $request->team_id)->get()]);
    }

    public function add_members(Request $request)
    {
        $member = TeamMember::create([
            'name' => $request->name,
            'rollno' => $request->rollno,
            'team_id' => $request->team_id,
            'user_id' => 1
        ]);

        if ($member) {
            return response()->json(['status' => 1, 'members' => $member]);
        }
    }

    public function manage_members($team_id)
    {
        return view('admin.projectlead.members', ['members' => TeamMember::where('team_id', $team_id)->get(), 'teamID' => $team_id]);
    }
}
