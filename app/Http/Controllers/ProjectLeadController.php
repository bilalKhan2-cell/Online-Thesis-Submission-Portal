<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\ProjectLead;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ProjectLeadController extends Controller
{
    private $genders = ['Male' => "Male", 'Female' => "Female"];
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(ProjectLead::with('department', 'users')->get())
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    $btn = "<a href='" . route('project_leads.edit', $row->id) . "'><i class='material-icons'>edit</i></a>";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.projectlead.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.projectlead.create', ['genders' => $this->genders, 'departments' => Department::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $projectLead = ProjectLead::create([
            'name' => $request->name,
            'fname' => $request->fname,
            'gender' => $request->gender,
            'address' => $request->address,
            'project_id' => $request->project_id,
            'rollno' => $request->rollno,
            'department_id' => $request->department,
            'cnic' => $request->cnic,
            'contact_info' => $request->contact_info,
            'status' => 1,
            'user_id' => 1,
            'email' => $request->email
        ]);

        if ($projectLead) {
            return redirect()->route('project_leads.index')->with('project_lead_success', "Project Lead Created Successfully..");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ProjectLead $projectLead)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProjectLead $projectLead)
    {
        return view('admin.projectlead.edit', ['data' => $projectLead->with('department')->first(), 'departments' => Department::all(), 'genders' => $this->genders]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProjectLead $projectLead)
    {
        $project_lead_new_data = [
            'name' => $request->name,
            'fname' => $request->fname,
            'gender' => $request->gender,
            'address' => $request->address,
            'project_id' => $request->project_id,
            'rollno' => $request->rollno,
            'department_id' => $request->department,
            'contact_info' => $request->contact_info,
            'user_id' => 1
        ];

        if ($projectLead->status == 0) {
            $project_lead_new_data['cnic'] = $request->cnic;
            $project_lead_new_data['email'] = $request->email;
        }

        if (ProjectLead::where('id', $projectLead->id)->update($project_lead_new_data)) {
            if ($projectLead->status == 0) {
                return redirect()->route('project_leads.index')->with('project_lead_edit_success', 'Project Lead Details Updated Successfully..');
            } else {
                return redirect()->route('project_leads.index')->with('project_lead_edit_success', 'Project Lead Details Updated Successfully..');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProjectLead $projectLead)
    {
        //
    }

    public function ActivateAccount(ProjectLead $lead)
    {
        if (ProjectLead::where('id', $lead->id)->update(['status' => 0])) {
            return redirect()->route('project_leads.index')->with('project_lead_inactive', "Project Lead Accont Marked Inactive.");
        }
    }

    public function InactivateAccount(ProjectLead $lead)
    {
        if (ProjectLead::where('id', $lead->id)->update(['status' => 1])) {
            return redirect()->route('project_leads.index')->with('project_lead_active', "Project Lead Accont Marked Active.");
        }
    }

    private function SendEmail($to, $projectLeadData)
    {
        $password = Str::random(8);

        ProjectLead::where('id', $projectLeadData)->update(['password' => $password]);
    }
}
