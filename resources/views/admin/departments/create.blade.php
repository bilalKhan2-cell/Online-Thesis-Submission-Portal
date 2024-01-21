@extends('layout.app')

@section('title')
    Departments
@endsection

@section('breadcrumbs')
    <x-breadcrumbs heading="Department" subHeading="Manage Department" page="Register Departments" />
@endsection

@section('content')
    <div class="row">
        <form id="frmDepartment" action="{{ route('departments.store') }}" method="POST">
            @csrf
            {!! InputField('s3', 'Name', ['name' => 'name', 'id' => 'txtDepartmentName'], 'text') !!}

            {!! InputField('s6', 'Comments (if any):', ['name' => 'comments'], 'text') !!}

            {!! submitAndCancelButton('Save', 'btn green', 's3 mt-3') !!}
        </form>
    </div>
@endsection

@push('script')
    <script>
        $("#frmDepartment").validate({
            rules: {
                name: {
                    required: true,
                    remote: {
                        url: "{{ route('departments.name.unique') }}",
                        type: "POST",
                        data: {
                            name: function() {
                                return $("#txtDepartmentName").val();
                            },
                            _token: "{{ csrf_token() }}"
                        },
                    }
                },
            },
            messages: {
                name: {
                    required: "Department Name is Required..",
                    remote: "Department With This Name is Already Exist."
                }
            }
        })
    </script>
@endpush
