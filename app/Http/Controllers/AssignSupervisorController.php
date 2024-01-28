<?php

namespace App\Http\Controllers;

use App\Models\AssignSupervisor;
use App\Models\Supervisor;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Department;
use App\Models\ProjectLead;

class AssignSupervisorController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(AssignSupervisor::with('team', 'supervisor', 'user_data')->get())
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    $btn = "edit";

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.assignsupervisor.index', ['department_list' => Department::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if (!ProjectLead::where('id', $request->teamID)->exists()) {
            return redirect()->back();
        } else {
            $supervisor_details = AssignSupervisor::with('supervisor')->where('team_id', $request->teamID)->first();

            return view('admin.assignsupervisor.assign', [
                'supervisor_list' => Supervisor::where('status', 1)->where('department_id', ProjectLead::find($request->teamID)->department_id)->get(),
                'team_id' => $request->teamID,
                'supervisor' => $supervisor_details ? $supervisor_details->supervisor : null,
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (AssignSupervisor::where('team_id', $request->team_id)->exists()) {
            AssignSupervisor::where('team_id', $request->team_id)
                ->update([
                    'supervisor_id' => $request->supervisor_id
                ]);
            return redirect()->route('assign_supervisor.index')->with('success', 'Supervisor Assigned Successfully..');
        } else {
            AssignSupervisor::create([
                'team_id' => $request->team_id,
                'supervisor_id' => $request->supervisor_id
            ]);
            return redirect()->route('assign_supervisor.index')->with('success', 'Superivosr Assigned Successfully..');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AssignSupervisor $assignSupervisor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AssignSupervisor $assignSupervisor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AssignSupervisor $assignSupervisor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AssignSupervisor $assignSupervisor)
    {
        //
    }

    public function details(Request $request)
    {
        $request->validate([
            'batch' => "required|numeric"
        ]);
        $teamIds = ProjectLead::where(['department_id' => $request->department, 'batch' => $request->batch])->get(['id']);

        $data = [];

        foreach ($teamIds as $key => $value) {
            array_push($data, ProjectLead::with('assign_supervisor')->find($value->id)->first());
        }

        return view('admin.assignsupervisor.index', ['assigning_supervisors_details' => $data, 'department_list' => Department::all()]);
    }
}
