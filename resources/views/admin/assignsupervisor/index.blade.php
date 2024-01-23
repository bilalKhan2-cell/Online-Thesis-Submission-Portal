@extends('layout.app')

@section('title')
    Assign Supervisor
@endsection

@section('breadcrumbs')
    <x-breadcrumbs heading="Assign Supervisor" subHeading="Manage Supervisor Assigning" page="List of Assigned Supervisors" />
@endsection

@section('content')
    <form id="frmData">
        @csrf
        <div class="row">
            {!! SelectField('s4', 'Select Department', 'department', $department_list) !!}
            {!! Button('Submit', 'btn blue mt-3', ['onclick' => 'FetchData']) !!}
        </div>
    </form>
    <br>
    {!! GenerateTable('#tblData', 'table table-hover striped', [
        'Team ID',
        'Lead Name',
        'Roll No.',
        'Assigned Status',
        'Action',
    ]) !!}
@endsection

@push('script')
    <script>
        function fetchData() {
            $("#tblData").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('assign_supervisor.details') }}",
                    type: "GET",
                    data: function(data) {
                        data.department_id = $("select[name='department']").val();
                    }
                },
                columns: [{
                        data: "id",
                        name: "id",
                        render: function(result) {
                            return "TEAM-" + result;
                        },
                    },
                    {
                        data: 'name',
                        name: 'name',
                        render:function(result){
                            return result.name
                        }
                    },
                    {
                        data: 'rollno',
                        name: 'rollno',
                        render:function(result){
                            return result.rollno
                        }
                    },
                    {
                        data: "supervisor",
                        name: "supervisor",
                        render: function(result) {
                            if (result.name != '') {
                                return "<span class='blue-text'>".result.name.
                                "</span>";
                            } else {
                                return "<span class='badge red'>Not Assigned Yet.</span>";
                            }
                        }
                    },
                    {
                        data:'action',
                        name:'action',
                        orderable:false,
                        searchable:false
                    }
                ]
            })
        }
    </script>
@endpush
