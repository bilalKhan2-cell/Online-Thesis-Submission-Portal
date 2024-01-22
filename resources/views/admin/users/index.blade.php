@extends('layout.app')

@section('title')
    Users Management
@endsection

@section('breadcrumbs')
    <x-breadcrumbs heading="User" subHeading="User Management" page="Registred Users" />
@endsection

@section('content')
    <div class="row">
        <div class="col s12">
            @if (session()->has('user-success'))
                {!! ShowAlertMessage('green', session()->get('user-success')) !!}
            @endif

            @if (session()->has('user-edit-success'))
                {!! ShowAlertMessage('blue', session()->get('user-edit-success')) !!}
            @endif

            @if (session()->has('user-inactive'))
                {!! ShowAlertMessage('red', session()->get('user-inactive')) !!}
            @endif

            @if (session()->has('user-active'))
                {!! ShowAlertMessage('red', session()->get('user-active')) !!}
            @endif

            @if (session()->has('invald-users'))
                {!! ShowAlertMessage('red', session()->get('invald-users')) !!}
            @endif

            <a href="{{ route('users.create') }}" class="btn blue float-right">Register User</a>
            <br><br>
            {!! GenerateTable('tblUsers', 'table table-hover striped', [
                'User ID',
                'Name',
                'Email',
                'CNIC',
                'Status',
                'Action',
            ]) !!}
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(".card-alert").delay(2500).fadeOut();
        $("#tblUsers").DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('users.index') }}",
            columns: [{
                    data: "id",
                    name: "id",
                    render: function(data) {
                        return "USER-" + data;
                    }
                },
                {
                    data: "name",
                    name: "name"
                },
                {
                    data: "email",
                    name: "email",
                },
                {
                    data: "cnic",
                    name: "cnic"
                },
                {
                    data: "status",
                    name: "status",
                    render: function(result) {
                        return result == "1" ? "<span class=' badge green'>Active</span>" :
                            "<span class=' badge red'>Inactive</span>";
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
