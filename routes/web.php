<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProjectLeadController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AssignSupervisorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.users.index');
});

Route::resource('departments', DepartmentController::class);
Route::post('/departments/name/unique', [DepartmentController::class, 'name_exist'])->name('departments.name.unique');

Route::resource('users', UserController::class);
Route::get('/users/{id}/inactive', [UserController::class, 'InactivateAccount'])->name('users.active');
Route::get('/users/{id}/activate', [UserController::class, 'ActivateAccount'])->name('users.inactive');

Route::resource('supervisors', SupervisorController::class);
Route::get('/supervisors/{id}/inactive', [SupervisorController::class, 'InactiveAccount'])->name('supervisors.inactive');
Route::get('/supervisors/{id}/activate', [SupervisorController::class, 'ActivateAccount'])->name('supervisors.active');

Route::resource('project_leads',ProjectLeadController::class);
Route::get('/check_valid',[ProjectLeadController::class,'check_validity'])->name('project_leads.check_validitiy');

Route::resource('assign_supervisor',AssignSupervisorController::class);
Route::get('/assign_supervisor/details',[AssignSupervisorController::class,'create'])->name('assign_supervisor.details');