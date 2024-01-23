@extends('layout.app')

@section('title')
    Manage Project Leads
@endsection

@section('breadcrumbs')
    <x-breadcrumbs heading="Project Leads" subHeading="Manage Project Leads Data" page="List of Project Leads" />
@endsection

@section('content')
    <div class="row">
        <div class="col s12">
            <a href="{{ route('project_leads.create') }}" class="btn blue float-right">Register Project Lead</a>
            <br><br>
            {!! GenerateTable('tblProjectLeads', 'table table-hover striped', [
                'Name',
                'Email',
                'CNIC',
                'Roll No',
                'Department',
                'Registered By',
                'Action',
            ]) !!}
        </div>
    </div>


    <div id="modalTeamMembers" class="modal modal-fixed-footer">
        <div class="modal-content">
            <div class="row">
                <input type="hidden" name="team_id" id="txtTeamID" />
                {!! InputField('s4', 'Team Member Name', ['name' => 'team_member_name', 'id' => 'txtTeamMemberName'], 'text') !!}
                {!! InputField('s4', 'Roll No.', ['name' => 'team_member_rollno', 'id' => 'txtTeamMemberRollNo'], 'text') !!}
            </div>
            <br>
            <span class="blue-text" id="lblMessage"></span>
            {!! GenerateTable('tblTeamMembers', 'table table-hover striped', [
                'S.No',
                'Team Member Name',
                'Roll No.',
                'Action',
            ]) !!}
        </div>
        <div class="modal-footer">
            <button class="modal-action modal-close waves-effect waves-green btn-flat">Close</button>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $("#tblProjectLeads").DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('project_leads.index') }}",
            columns: [{
                    data: 'name',
                    name: "name"
                },
                {
                    data: "email",
                    name: 'email'
                },
                {
                    data: "cnic",
                    name: 'cnic'
                },
                {
                    data: 'rollno',
                    name: 'rollno'
                },
                {
                    data: 'department',
                    name: "department",
                    render: function(result) {
                        return result.name;
                    }
                },
                {
                    data: 'users',
                    name: 'users',
                    render: function(result) {
                        return result.name;
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

    </script>
@endpush
