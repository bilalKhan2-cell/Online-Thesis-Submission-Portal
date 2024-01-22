<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(Department::with('user')->get())
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return "<a href='" . route('departments.edit', $row->id) . "' class='btn green'><i class='material-icons'>edit</i></a>";
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.departments.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Department::create(['name' => $request->name, 'description' => $request->comments, 'user_id' => 1]);
        return redirect()->route('departments.index')->with('department-success', 'Department Added Successfully..');
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        return view('admin.departments.edit', ['data' => $department]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        Department::where('id', $department->id)->update(['name' => $request->name, 'description' => $request->comments, 'user_id' => 1]);
        return redirect()->route('departments.index')->with('department-edit-success', 'Department Details Updated Successfully..');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        //
    }

    public function name_exist(Request $request)
    {
        return response()->json(!Department::where('name', ucwords($request->name))->exists());
    }
}
