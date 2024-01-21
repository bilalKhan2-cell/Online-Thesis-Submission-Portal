@extends('layout.app')

@section('title')
    Manage Supervisors
@endsection

@section('breadcrumbs')
    <x-breadcrumbs heading="Supervisor" subHeading="Manage Supervisors" page="List of Supervisiors" />
@endsection

@section('content')
    <div class="row">
        <div class="col s12">
            @if (session()->has('supervisor-success'))
                {!! ShowAlertMessage('green', session()->get('supervisor-success')) !!}
            @endif

            @if (session()->has('supervisor-edit-success'))
                {!! ShowAlertMessage('blue', session()->get('supervisor-edit-success')) !!}
            @endif

            @if (session()->has('supervisor-inactive'))
                {!! ShowAlertMessage('red', session()->get('supervisor-inactive')) !!}
            @endif

            @if (session()->has('supervisor-active'))
                {!! ShowAlertMessage('pink', session()->get('supervisor-active')) !!}
            @endif

            <a href="{{ route('supervisors.create') }}" class="btn blue float-right">Add Supervisor</a>
            <br><br>
            {!! GenerateTable('tblSupervisors', 'table table-hover striped', [
                'Supervisor ID',
                'Name',
                'Email',
                'CNIC',
                'Department',
                'Status',
                'Action',
            ]) !!}
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(".card-alert").delay(2500).fadeOut();
        $("#tblSupervisors").DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('supervisors.index') }}",
            columns: [{
                    data: "id",
                    name: "id",
                    render: function(result) {
                        return "SPR-" + result
                    }
                }, {
                    data: "name",
                    name: "name"
                },
                {
                    data: "email",
                    name: 'email',
                }, {
                    data: "cnic",
                    name: "cnic"
                }, {
                    data: "department",
                    name: "department",
                    render: function(result) {
                        return result.name
                    },
                    orderable: true,
                    searchable: true
                }, {
                    data: "status",
                    name: "status",
                    render: function(result) {
                        return result == "1" ? "<span class='badge green'>Active</span>" :
                            "<span class='badge red'>Inactive</span>";
                    }
                }, {
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false
                }
            ]
        })
    </script>
@endpush
