<?php

namespace App\Http\Controllers;

use App\Models\AssignSupervisor;
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
        $details = [];
        $team_and_supervisor_details = ProjectLead::where('department_id', $request->department_id)->get(['id']);

        foreach ($team_and_supervisor_details as $key => $value) {
            $assign_supervisor_data = AssignSupervisor::with('team', 'supervisor')->where('team_id', $value)->first();
            array_push($details, $assign_supervisor_data);
        }

        return DataTables::of($details)
               ->addIndexColumn()
               ->addColumns('status',function($row){
                    return "";
               })
               ->rawColumns(['action'])
               ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
}
