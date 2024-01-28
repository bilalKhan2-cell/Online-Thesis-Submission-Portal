<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProjectLeadController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\TeamMemberController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AssignSupervisorController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'show_login']);
Route::get('/forgot',[UserController::class,'show_forgot_password_page'])->name('users.forgot');
Route::get('/change_password',[UserController::class,'show_change_password_page'])->name('users.show_change_password_page');

Route::post('/login', [UserController::class, 'login'])->name('users.login');
Route::post('/send_otp',[UserController::class,'send_otp'])->name('users.sendotp');
Route::post('/update_password',[UserController::class,'update_password'])->name('users.update_password');

Route::middleware(['is_login'])->group(function () {
    Route::get('/logout', [UserController::class, 'logout'])->name('users.logout');

    Route::middleware(['is_user'])->group(function () {

        Route::get('/admin/dashboard', [UserController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/admin/profile', [UserController::class, 'profile'])->name('admin.profile');

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
        // Route::get('/assign_supervisor/{id}/assign', [AssignSupervisorController::class, 'create'])->name('assign_supervisor.create');

        Route::prefix('members')->group(function () {
            Route::get('/{id}/members', [TeamMemberController::class, 'manage_members'])->name('team_members.manage');
        });

        Route::get('/get_members', [TeamMemberController::class, 'get_members_by_team_id'])->name('team_members.get_members');
        Route::post('/add_member', [TeamMemberController::class, 'add_members'])->name('team_members.add_member');
        Route::get('/delete_member/{id}', [TeamMemberController::class, 'destroy'])->name('team_members.remove_member');

    });

    Route::middleware(['is_team_lead'])->group(function () {
        Route::prefix('team')->group(function () {
            Route::get('/dashboard', [ProjectLeadController::class, 'dashboard'])->name('team.dashboard');
            Route::get('/profile', [ProjectLeadController::class, 'profile'])->name('team.profile');
            Route::get('/upload_thesis', [ProjectLeadController::class, 'show_upload_thesis'])->name('team.show_upload_thesis');
            Route::get('/check_thesis_status', [ProjectLeadController::class, 'check_thesis_status'])->name('team.check_thesis_status');
            Route::get('/thesis_grading', [ProjectLeadController::class, 'thesis_grading'])->name("team.thesis_grading");

            Route::post('/thesis/upload', [ProjectLeadController::class, 'upload_thesis'])->name('team.upload_thesis');
        });
    });

    Route::middleware(['is_supervisor'])->group(function () {
        Route::prefix('supervisor')->group(function () {
            Route::get('/dashboard', [SupervisorController::class, 'dashboard'])->name('supervisor.dashboard');
            Route::get('/profile', [SupervisorController::class, 'profile'])->name('supervisor.profile');
            Route::get('/list_thesis',[SupervisorController::class,'process_thesis'])->name('supervisors.process_thesis');
            Route::get('/thesis_grading', [SupervisorController::class, 'thesis_grading'])->name('supervisors.thesis_grading');
            Route::get('/thesis/{id}/reviews',[SupervisorController::class,'reviewing_thesis'])->name('supervisors.review_thesis');
            Route::get('/marks/fetch',[SupervisorController::class,'get_marks'])->name('supervisors.get_marks');

            Route::post('/thesis/list',[SupervisorController::class,'manage_thesis_status'])->name('supervisors.manage_thesis_status');
            Route::post('/status/{id}/submit', [SupervisorController::class, 'submit_reviews'])->name('supervisors.submit_reviews');
            Route::post('/fetch_marks',[SupervisorController::class,'fetch_marks'])->name('supervisors.fetch_marks');
            Route::post('/submit_marks',[SupervisorController::class,'submit_marks'])->name('supervisors.submit_marks');
        });
    });
});