@extends('layout.app')

@section('title') Assign Supervisor @endsection

@section('breadcrumbs')
    <x-breadcrumbs heading="Assign Supervisor" subHeading="Manage Supervisor Assigning" page="List of Assigned Supervisors" />
@endsection

@section('content')
    <div class="row">
        {!! SelectField('s4','Select Department','department',$department_list)  !!}
    </div>
@endsection