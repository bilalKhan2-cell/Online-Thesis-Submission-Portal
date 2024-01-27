@extends('layout.app')

@section('title')
    Welcome
@endsection

@section('breadcrumbs')
    <x-breadcrumbs heading="Dashboard" subHeading="Project Lead" page="Welcome Page" />
@endsection

@section('content')
    @if (session()->has('upload_success'))
        {!! ShowAlertMessage('green', session()->get('upload_success')) !!}
    @endif

    <div class="row">
        <div class="col s12">
            <h6>Supervisor</h6>
            <hr>
        </div>
        <div class="col s12">
            @if (!is_null($supervisor))
                <table class="table table-hover striped blue-text">
                    <thead>
                        <tr>
                            <td>Supervior Name</td>
                            <td>{{ $supervisor->supervisor->name }}</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Email Address</td>
                            <td>{{ $supervisor->supervisor->email }}</td>
                        </tr>
                    </tbody>
                </table>
            @else
                <table class="table table-hover striped red-text">
                    <thead>
                        <tr>
                            <td>Supervior Not Assigned Yet.</td>
                        </tr>
                    </thead>
                </table>
            @endif
        </div>
    </div>

    <div class="row mt-2">
        <div class="col s12">
            <h6>Team Members: </h6>
            <hr />
        </div>
        <div class="col s12">
            <table class="table table-hover striped green-text">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Roll No.</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($members as $key => $value)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->rollno }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
