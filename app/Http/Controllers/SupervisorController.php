<?php

namespace App\Http\Controllers;

use App\Mail\SupervisorRegistrationMail;
use App\Models\Department;
use App\Models\Supervisor;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SupervisorController extends Controller
{
    private $genders = ['Male' => "Male", "Female" => "Female"];
    private $status = ['1' => "Active", "0" => "Inactive"];
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(Supervisor::with('department')->get())
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = "<a class='blue-text' href='" . route('supervisors.edit', $row->id) . "'><i class='material-icons'>edit<i></a>";
                    if ($row->status == 0) {
                        $btn .= "<a class='yellow-text' href='" . route('supervisors.active', $row->id) . "'><i class='material-icons'>add_circle</i></a>";
                    } else {
                        $btn .= "<a class='red-text ml-2' href='" . route('supervisors.inactive', $row->id) . "'><i class='material-icons'>visibility_off</i></a>";
                    }

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.supervisors.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.supervisors.create', ['department_list' => Department::all(), 'genders' => $this->genders]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $supervisor = Supervisor::create([
            'name' => $request->name,
            'fname' => $request->fname,
            'gender' => $request->gender,
            'address' => $request->address,
            'cnic' => $request->cnic,
            'contact_info' => $request->contact_info,
            'department_id' => $request->department,
            'email' => $request->email,
            'user_id' => 1,
            "status" => 1
        ]);

        if ($this->SendEmail($supervisor->email, $supervisor)) {
            return redirect()->route('supervisors.index')->with('supervisor-success', 'Supervisor Registered Successfully..');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Supervisor $supervisor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supervisor $supervisor)
    {
        return view('admin.supervisors.edit', ['status' => $this->status, 'data' => $supervisor, 'genders' => $this->genders, 'department_list' => Department::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supervisor $supervisor)
    {
        $updateData = [
            'name' => $request->name,
            'fname' => $request->fname,
            'gender' => $request->gender,
            'address' => $request->address,
            'contact_info' => $request->contact_info,
            'department_id' => $request->department,
            'user_id' => 1,
        ];

        if ($supervisor->status == 0) {
            $updateData['email'] = $request->email;
            $updateData['cnic'] = $request->cnic;
        }

        $updated_supervisor = Supervisor::where('id', $supervisor->id)
            ->update($updateData);

        if ($updated_supervisor && $supervisor->status == 0) {
            if ($this->SendEmail($updateData['email'], $supervisor)) {
                return redirect()->route('supervisors.index')->with('supervisor-edit-success', 'Supervisor\'s Details Updated Succesfully..');
            }
        } else {
            return redirect()->route('supervisors.index')->with('supervisor-edit-success', 'Supervisor\'s Details Updated Succesfully..');
        }
    }

    public function destroy(Supervisor $supervisor)
    {
        return true;
    }

    public function InactiveAccount($supervisorID)
    {
        $data = Supervisor::where('id', $supervisorID)->update(['status' => 0]);
        if ($data) {
            return redirect()->back()->with('supervisor-inactive', 'Supervisor Account Marked Inactive..');
        }
    }

    public function ActivateAccount($supervisorID)
    {
        $data = Supervisor::where('id', $supervisorID)->update(['status' => 1]);
        if ($data) {
            return redirect()->back()->with('supervisor-active', 'Supervisor Account Marked Active..');
        }
    }

    private function SendEmail($to, $entity)
    {
        $password = Str::random(8);

        Supervisor::where('id', $entity->id)->update(['password' => bcrypt($password)]);

        $emailContent = view('emails.supervisor_registration', ['password' => $password, 'supervisor' => $entity])->render();

        if (Mail::to($to)->send(new SupervisorRegistrationMail($emailContent))) {
            Supervisor::where('id',$entity->id)->update(['status' => 1]);
            return true;
        }
    }
}
