@extends('layout.app')

@section('title') Profile @endsection

@section('breadcrumbs')
    <x-breadcrumbs heading="Dashboard" subHeading="Supervisor" page="Profile" />
@endsection

@section('content')
    <a href="{{route('supervisor.dashboard')}}" class="btn red"><i class="material-icons">arrow_left</i></a>
    <br><br>
    <div class="row">
        <div class="col s4">Name: </div>
        <div class="col s4">{{ Auth::guard('supervisor')->user()->name }}</div>
    </div>

    <div class="row mt-2">
        <div class="col s4">Email: </div>
        <div class="col s4">{{ Auth::guard('supervisor')->user()->email }}</div>
    </div>

    <div class="row mt-2">
        <div class="col s4">Contact Info: </div>
        <div class="col s4">{{ Auth::guard('supervisor')->user()->contact_info }}</div>
    </div>

    <div class="row mt-2">
        <div class="col s4">CNIC No: </div>
        <div class="col s4">{{ Auth::guard('supervisor')->user()->cnic }}</div>
    </div>

    <div class="row mt-2">
        <div class="col s4">Department: </div>
        <div class="col s4">{{ Auth::guard('supervisor')->user()->department->name }}</div>
    </div>
@endsection