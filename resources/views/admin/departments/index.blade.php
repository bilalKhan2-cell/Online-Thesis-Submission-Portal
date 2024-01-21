@extends('layout.app')

@section('title')
    Departments
@endsection

@section('breadcrumbs')
    <x-breadcrumbs heading="Department" subHeading="Manage Department" page="List of Departments" />
@endsection

@section('content')
    @if (session()->has('department-success'))
        {!! ShowAlertMessage('green', session()->get('department-success')) !!}
    @endif

    @if (session()->has('department-edit-success'))
        {!! ShowAlertMessage('blue', session()->get('department-edit-success')) !!}
    @endif

    <a href="{{ route('departments.create') }}" class="btn float-right blue">Add Department</a>
    <br><br>
    {!! GenerateTable('tblDepartments', 'table table-hover striped', [
        'Department ID',
        'Name',
        'Registered By',
        'Action',
    ]) !!}
@endsection

@push('script')
    <script>
        $(".card-alert").delay(2500).fadeOut();
        $("#tblDepartments").DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('departments.index') }}",
            columns: [{
                    data: "id",
                    name: "id",
                    render: function(data) {
                        return "DEPT-" + data;
                    }
                },
                {
                    data: "name",
                    name: "name"
                },
                {
                    data: "user",
                    name: "user",
                    render: function(user) {
                        return user.name;
                    }
                },
                {
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false
                }
            ]
        });
    </script>
@endpush
