<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPasswordMail;
use App\Mail\UserRegistrationMail;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Department;
use App\Models\Supervisor;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\ProjectLead;

class UserController extends Controller
{
    private $genders = ['Male' => "Male", "Female" => "Female"];
    private $status = ['1' => "Active", '0' => "Inactive"];

    public function show_login()
    {
        if (Auth::guard('web')->check()) {
            return redirect()->route('admin.dashboard');
        } else if (Auth::guard('supervisor')->check()) {
            return redirect()->route('supervisor.dashboard');
        } else if (Auth::guard('project_leads')->check()) {
            return redirect()->route('team.dashboard');
        } else {
            return view('login');
        }
    }

    public function login(Request $request)
    {

        $request->validate([
            'email' => "required|email",
            "password" => "required"
        ]);

        $credentials = ['email' => $request->email, 'password' => ($request->password)];

        if (Auth::attempt($credentials)) {
            if (Auth::guard('web')->user()->status == 0) {
                Auth::guard('web')->logout();
                return redirect()->back()->with('login-inactive', 'Your Account Have Marked Inactive From The Administration Department..');
            }
            return redirect()->route('admin.dashboard');
        } else if (Auth::guard('supervisor')->attempt($credentials)) {
            if (Auth::guard('supervisor')->user()->status == 0) {
                Auth::guard('supervisor')->logout();
                return redirect()->back()->with('login-inactive', 'Your Account Have Marked Inactive From The Administration Department..');
            }
            return redirect()->route('supervisor.dashboard');
        } else if (Auth::guard('project_leads')->attempt($credentials)) {
            if (Auth::guard('project_leads')->user()->status == 0) {
                Auth::guard('project_leads')->logout();
                return redirect()->back()->with('login-inactive', 'Your Account Have Marked Inactive From The Administration Department..');
            }
            return redirect()->route('team.dashboard');
        } else {
            return redirect()->back()->with('invalid-error', 'Invalid Login Credentials..');
        }
    }

    public function profile()
    {
        return view('admin.profile');
    }

    public function dashboard()
    {
        $counts = [];
        $counts['departments'] = Department::all()->count();
        $counts['supervisors'] = Supervisor::all()->count();

        return view('admin.dashboard', ['data' => $counts]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(User::where('id', '>', 1)->get())
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = "<a class='blue-text' href='" . route('users.edit', $row->id) . "'><i class='material-icons'>edit<i></a>";
                    if ($row->status == 0) {
                        $btn .= "<a class='yellow-text' href='" . route('users.inactive', $row->id) . "'><i class='material-icons'>add_circle</i></a>";
                    } else {
                        $btn .= "<a class='red-text ml-2' href='" . route('users.active', $row->id) . "'><i class='material-icons'>visibility_off</i></a>";
                    }

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.users.index');
    }

    public function create()
    {
        return view('admin.users.create', ['genders' => $this->genders]);
    }

    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'cnic' => $request->cnic,
            'contact_info' => $request->contact_info,
            'email_verified_at' => NULL,
            'status' => 1,
            'remember_token' => $request->_token
        ]);

        if ($this->SendMail($user->email, $user)) {
            return redirect()->route('users.index')->with('user-success', 'User Registered Successfully..');
        }
    }

    public function show(User $user)
    {

    }

    public function edit(User $user)
    {
        if ($user->id == 1) {
            return redirect()->route('users.index')->with('invalid-users', 'Admin User Details Can\'t Be Editable..');
        }

        return view('admin.users.edit', ['genders' => $this->genders, 'user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        if ($user->id == 1) {
            return redirect()->route('users.index')->with('invald-users', 'Admin User Details Can\'t Be Editable..');
        }

        $updatedUserData = [
            'name' => $request->name,
            'address' => $request->address,
            'contact_info' => $request->contact_info,
            'email_verified_at' => NULL,
            'status' => 1,
            'remember_token' => $request->_token
        ];

        if ($user->status == 0) {
            $updatedUserData['email'] = $request->email;
            $updatedUserData['cnic'] = $request->cnic;
        }

        User::where('id', $user->id)->update($updatedUserData);

        if ($updatedUserData && $user->status == 0) {
            if ($this->SendMail($updatedUserData['email'], $user)) {
                return redirect()->route('users.index')->with('user-edit-success', 'User Detail\'s Updated Successfully..');
            }
        } else {
            return redirect()->route('users.index')->with('user-edit-success', 'User Detail\'s Updated Successfully..');
        }
    }

    public function destroy(User $user)
    {

    }

    public function ActivateAccount($userID)
    {
        $data = User::find($userID)->update(['status' => 1]);
        if ($data) {
            return redirect()->route('users.index')->with('user-active', 'User Account Marked Active..');
        }
    }

    public function InactivateAccount($userID)
    {
        $data = User::find($userID)->update(['status' => 0]);
        if ($data) {
            return redirect()->route('users.index')->with('user-inactive', 'User Account Marked Inactive..');
        }
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        Auth::guard('supervisor')->logout();
        Auth::guard('project_leads')->logout();
        return redirect()->to('/');
    }

    public function show_forgot_password_page()
    {
        return view('forgot');
    }

    public function send_otp(Request $request)
    {
        $email = $request->email;

        if (Auth::guard('web')->attempt(['email' => $email])) {
            $this->SendForgotPasswordMail($email, Auth::guard('web')->user(), 'user');
            session()->put('change_password', 'user');
            session()->put('email', $email);
        } else if (Auth::guard('supervisor')->attempt(['email' => $email])) {
            $this->SendForgotPasswordMail($email, Auth::guard('supervisor')->user(), 'supervisor');
            session()->put('change_password', 'supervisor');
            session()->put('email', $email);
        } else if (Auth::guard('project_leads')->attempt(['email' => $email])) {
            $this->SendForgotPasswordMail($email, Auth::guard('project_leads')->user(), 'project_lead');
            session()->put('change_password', 'project_lead');
            session()->put('email', $email);
        } else {
            return redirect()->back()->with('invalid_login', 'Account Not Exist..');
        }

        return redirect();
    }

    public function show_change_password_page()
    {
        return view('change_password');
    }

    public function update_password(Request $request)
    {
        $request->validate([
            'password' => "required|min:6",
            "confirm_password" => "required|same:password",
            "code" => "required"
        ]);

        if (session()->get('change_password') == 'user') {
            if (User::where('password_reset_code', $request->code)->where('email', session()->get('email'))->exists()) {
                User::where('email', session()->get('email'))->update(['password' => bcrypt($request->password)]);
            }
        } else if (session()->get('change_password') == 'supervisor') {
            if (Supervisor::where('password_reset_code', $request->code)->where('email', session()->get('email'))->exists()) {
                Supervisor::where('email', session()->get('email'))->update(['password' => bcrypt($request->password)]);
            }
        } else if (session()->get('change_password') == 'project_leads') {
            if (ProjectLead::where('password_reset_code', $request->code)->where('email', session()->get('code'))->exists()) {
                ProjectLead::where('email', session()->get('email'))->update(['password' => bcrypt($request->password)]);
            }
        }

        return redirect()->to('/')->with('change_passwrod_success', 'Account Password Updated Successfully..');
    }

    private function SendMail($to, $user)
    {
        $password = Str::random(8);

        $emailContent = view('emails.user_registration', ['password' => $password, 'user' => $user, 'token' => $user->remember_token])->render();

        User::where('id', $user->id)->update(['password' => bcrypt($password)]);
        if (Mail::to($to)->send(new UserRegistrationMail($emailContent))) {
            return true;
        }
    }

    private function SendForgotPasswordMail($to, $user, $modelType)
    {
        $otp = rand(100000, 999999);

        if ($modelType == 'user') {
            User::where('email', $to)->update(['password_reset_code' => $otp]);
            $emailContent = view('forgot', ['user' => Auth::guard('web')->user(), 'otp' => $otp])->render();
        } else if ($modelType == 'supervisor') {
            Supervisor::where('email', $to)->update(['password_reset_code' => $otp]);
            $emailContent = view('forgot', ['user' => Auth::guard('supervisor')->user(), 'otp' => $otp])->render();
        } else if ($modelType == 'project_leads') {
            ProjectLead::where('email', $to)->update(['password_reset_code' => $otp]);
            $emailContent = view('forgot', ['user' => Auth::guard('project_leads')->user(), 'otp' => $otp])->render();
        }

        if (Mail::to($to)->send(new ForgotPasswordMail($emailContent))) {
            return true;
        }
    }
}
