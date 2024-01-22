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
        })
    </script>
@endpush
