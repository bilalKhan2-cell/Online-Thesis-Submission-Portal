<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProjectLeadController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\TeamMemberController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AssignSupervisorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.users.index');
});

Route::get('/admin',[UserController::class,'dashboard'])->name('admin.dashboard');

Route::resource('departments', DepartmentController::class);
Route::post('/departments/name/unique', [DepartmentController::class, 'name_exist'])->name('departments.name.unique');

Route::resource('users', UserController::class);
Route::get('/users/{id}/inactive', [UserController::class, 'InactivateAccount'])->name('users.active');
Route::get('/users/{id}/activate', [UserController::class, 'ActivateAccount'])->name('users.inactive');

Route::resource('supervisors', SupervisorController::class);
Route::get('/supervisors/{id}/inactive', [SupervisorController::class, 'InactiveAccount'])->name('supervisors.inactive');
Route::get('/supervisors/{id}/activate', [SupervisorController::class, 'ActivateAccount'])->name('supervisors.active');

Route::resource('project_leads', ProjectLeadController::class);
Route::get('/check_valid', [ProjectLeadController::class, 'check_validity'])->name('project_leads.check_validitiy');
Route::get('/get_members', [ProjectLeadController::class, 'get_members'])->name('project_leads.get_members');

Route::resource('assign_supervisor', AssignSupervisorController::class);
Route::post('/assign_supervisor/details', [AssignSupervisorController::class, 'details'])->name('assign_supervisor.details');
Route::get('/assign_supervisor/{id}/assign',[AssignSupervisorController::class,'create'])->name('assign_supervisor.create');

Route::prefix('members')->group(function(){
    Route::get('/{id}/members',[TeamMemberController::class,'manage_members'])->name('team_members.manage');
});
Route::get('/get_members', [TeamMemberController::class, 'get_members_by_team_id'])->name('team_members.get_members');
Route::post('/add_member',[TeamMemberController::class,'add_members'])->name('team_members.add_member');