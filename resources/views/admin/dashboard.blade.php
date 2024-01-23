@extends('layout.app')

@section('title')
    Dashboard
@endsection

@section('breadcrumbs')
    <x-breadcrumbs heading="Dashboard" subHeading="Admin" page="Welcome" />
@endsection

@section('content')
    <div class="row">
        <div class="col s3">
            <div class="card gradient-45deg-light-blue-cyan gradient-shadow">
                <div class="card-content white-text">
                    <span class="card-title">Departments</span>
                    <h4><i class="material-icons" style="display:inline; color:white;">apartment</i> <span class="white-text">{{ $data['departments'] }} </span></h4>
                </div>
            </div>
        </div>

        <div class="col s3">
            <div class="card gradient-45deg-deep-purple-blue gradient-shadow">
                <div class="card-content white-text">
                    <span class="card-title">Supervisors</span>
                    <h4><i class="material-icons" style="display:inline; color:white;">group</i> <span class="white-text">{{ $data['supervisors'] }} </span></h4>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
