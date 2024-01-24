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
        if (count(TeamMember::where('team_id', $request->team_id)->get()) == 3) {
            return redirect()->back()->with('limit-exceeded',"Maximum Team Members Assigned");
        } else if (TeamMember::where('rollno', $request->team_member_rollno)->exists()) {
            return redirect()->back()->with('already-exist', "This Roll No. Is Already a Member of Team-" . TeamMember::with('team')->where('rollno', $request->team_member_rollno)->first()->id);
        } else {

            $member = TeamMember::create([
                'name' => ucwords($request->team_member_name),
                'rollno' => $request->team_member_rollno,
                'team_id' => $request->team_id,
                'user_id' => 1
            ]);

            if ($member) {
                return redirect()->back()->with('success','Team Members Added Successfully..');
            }
        }
    }

    public function manage_members($team_id)
    {
        return view('admin.projectlead.members', ['members' => TeamMember::where('team_id', $team_id)->get(), 'teamID' => $team_id]);
    }

    public function destroy($id){
        if(TeamMember::destroy($id)){
            return redirect()->back()->with('success','Team Member Deleted Successfully..');
        }
    }
}
