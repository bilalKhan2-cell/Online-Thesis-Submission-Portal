@extends('layout.app')

@section('title') Profile @endsection

@section('breadcrumbs')
    <x-breadcrumbs heading="Dashboard" subHeading="Admin" page="Admin Profile" />
@endsection

@section('content')
    <a href="{{route('admin.dashboard')}}" class="btn red"><i class="material-icons">arrow_left</i></a>
    <div class="row mt-2">
        <div class="col s4">Username: </div>
        <div class="col s4">{{ Auth::user()->name }}</div>
    </div>

    <div class="row mt-2">
        <div class="col s4">Email Address: </div>
        <div class="col s4">{{ Auth::user()->email }}</div>
    </div>

    <div class="row mt-2">
        <div class="col s4">Contact Info: </div>
        <div class="col s4">{{ Auth::user()->contact_info }}</div>
    </div>

    <div class="row mt-2">
        <div class="col s4">CNI No: </div>
        <div class="col s4">{{ Auth::user()->cnic }}</div>
    </div>

    <div class="row mt-2">
        <div class="col s4">Address: </div>
        <div class="col s4">{{ Auth::user()->address }}</div>
    </div>
@endsection