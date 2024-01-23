@extends('layout.app')

@section('title')
    Superivsor Assigning
@endsection

@section('breadcrumbs')
    <x-breadcrumbs heading="Project Lead" subHeading="Manage Project Lead Data" page="Assign Supervisor" />
@endsection

@section('content')
    <form action="{{ route('assign_supervisor.store') }}" method="POST">
        @csrf
        <div class="row">
            <input type="hidden" name="team_id" value="{{ $team_id }}">
            {!! SelectField('s4', 'Select Supervisor', 'supervisor_id', $supervisor_list) !!}
            {!! submitAndCancelButton('Submit', 'btn blue', 's4 mt-3') !!}
        </div>
    </form>
    <br>
    @if (isset($supervisor))
        <table class="table-hover striped">
            <thead>
                <tr>
                    <th>Supervisor Name</th>
                    <th>Supervisor Email</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $supervisor->name }}</td>
                    <td>{{ $supervisor->email }}</td>
                </tr>
            </tbody>
        </table>
    @endif
@endsection
