@extends('layout.app')

@section('title')
    Team Members
@endsection

@section('breadcrumbs')
    <x-breadcrumbs heading="Project Lead" subHeading="Manage Project Lead Data" page="Managing Team Members" />
@endsection

@section('content')
    @if (session()->has('limit-exceeded'))
        {!! ShowAlertMessage('red', session()->get('limit-exceeded')) !!}
    @endif

    @if (session()->has('already-exist'))
        {!! ShowAlertMessage('red', session()->get('already-exist')) !!}
    @endif

    @if (session()->has('success'))
        {!! ShowAlertMessage('green', session()->get('success')) !!}
    @endif

    <form action="{{ route('team_members.add_member') }}" method="POST">
        @csrf
        <div class="row">
            <input type="hidden" name="team_id" id="txtTeamID" value="{{ $teamID }}" />
            {!! InputField('s4', 'Team Member Name', ['name' => 'team_member_name', 'id' => 'txtTeamMemberName'], 'text') !!}
            {!! InputField('s4', 'Roll No.', ['name' => 'team_member_rollno', 'id' => 'txtTeamMemberRollNo'], 'text') !!}
            {!! submitAndCancelButton('Add Member', 'btn brown', 's4 mt-2') !!}
        </div>
    </form>
    <br>
    <table class="table table-hover striped">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Name</th>
                <th>Roll No</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($members as $key => $value)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->rollno }}</td>
                    <td>
                        <a href="{{ route('team_members.remove_member', $value->id) }}" class="btn red"><i
                                class="material-icons">delete</i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
@endsection
