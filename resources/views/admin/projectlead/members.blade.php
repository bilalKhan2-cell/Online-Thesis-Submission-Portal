@extends('layout.app')

@section('title')
    Team Members
@endsection

@section('breadcrumbs')
    <x-breadcrumbs heading="Project Lead" subHeading="Manage Project Lead Data" page="Managing Team Members" />
@endsection

@section('content')
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
                        <button class="btn red"><i class="material-icons">delete</i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
@endsection
