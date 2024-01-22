<?php

namespace App\Http\Controllers;

use App\Models\AssignSupervisor;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

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

        return view('admin.assignsupervisor.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
