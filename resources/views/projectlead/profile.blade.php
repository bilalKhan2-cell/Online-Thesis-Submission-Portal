@extends('layout.app')

@section('title') Welcome @endsection

@section('breadcrumbs')
    <x-breadcrumbs heading="Dashboard" subHeading="Project Lead" page="Profile" />
@endsection

@section('content')
    <a href="{{route('team.dashboard')}}" class="btn red"><i class="material-icons">arrow_left</i></a>
    <br><br>
    <div class="row">
        <div class="col s4">Name: </div>
        <div class="col s4">{{ Auth::guard('project_leads')->user()->name }}</div>
    </div>

    <div class="row mt-2">
        <div class="col s4">Roll No: </div>
        <div class="col s4">{{ Auth::guard('project_leads')->user()->rollno }}</div>
    </div>

    <div class="row mt-2">
        <div class="col s4">Email: </div>
        <div class="col s4">{{ Auth::guard('project_leads')->user()->email }}</div>
    </div>

    <div class="row mt-2">
        <div class="col s4">Contact Info: </div>
        <div class="col s4">{{ Auth::guard('project_leads')->user()->contact_info }}</div>
    </div>

    <div class="row mt-2">
        <div class="col s4">CNIC No: </div>
        <div class="col s4">{{ Auth::guard('project_leads')->user()->cnic }}</div>
    </div>

    <div class="row mt-2">
        <div class="col s4">Department: </div>
        <div class="col s4">{{ Auth::guard('project_leads')->user()->department->name }}</div>
    </div>
@endsection