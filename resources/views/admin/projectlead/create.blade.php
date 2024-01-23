@extends('layout.app')

@section('title')
    Create Project Lead
@endsection

@section('breadcrumbs')
    <x-breadcrumbs heading="Project Lead" subHeading="Manage Project Lead Data" page="Register Project Lead" />
@endsection

@section('content')
    @if (session()->has('existing_project_id'))
        <div class="row">
            <div class="col s12">
                {!! ShowAlertMessage('warning', session()->get('existing_project_id')) !!}
            </div>
        </div>
    @endif

    <form action="{{ route('project_leads.store') }}" method="POST" id="frmProjectLead">
        @csrf
        <div class="row">
            {!! InputField('s3', 'Project ID', ['name' => 'project_id'], 'text') !!}
        </div>

        <div class="row mt-2">
            {!! InputField('s4', 'Project Lead Name', ['name' => 'name'], 'text') !!}

            {!! InputField('s4', 'Father Name', ['name' => 'fname'], 'text') !!}

            {!! StaticSelectField('s4', 'Select Gender', 'gender', $genders) !!}
        </div>

        <div class="row mt-2">
            {!! InputField('s4', 'Email', ['name' => 'email', 'id' => 'txtEmailAddress'], 'email') !!}

            {!! InputField('s4', 'Roll No.', ['name' => 'rollno', 'id' => 'txtRollNo'], 'text') !!}

            {!! InputField('s4', 'Contact Info', ['name' => 'contact_info', 'id' => 'txtContactInfo'], 'text') !!}

            {!! InputField('s4', 'CNIC No.', ['name' => 'cnic', 'id' => 'txtCNIC'], 'text') !!}

            {!! SelectField('s4', 'Select Department', 'department', $departments, '') !!}

            {!! InputField('s12', 'Address.', ['name' => 'address', 'id' => 'txtAddress'], 'text') !!}

            {!! submitAndCancelButton('Submit', 'btn green', 's4') !!}

        </div>
    </form>
@endsection

@push('script')
    <script>
        $("#frmProjectLead").validate({
            rules: {
                name: {
                    required: true
                },
                fname: {
                    required: true
                },
                address: {
                    required: true,
                },
                contact_info: {
                    required: true,
                },
                cnic: {
                    required: true,
                    remote: {
                        url: "{{ route('project_leads.check_validitiy') }}",
                        type: "GET",
                        data: {
                            name: $("#txtCNIC").val(),
                            column_name: "cnic"
                        }
                    }
                },
                email: {
                    required: true,
                    remote: {
                        url: "{{ route('project_leads.check_validitiy') }}",
                        type: "GET",
                        data: {
                            name: $("#txtEmailAddress").val(),
                            column_name: "email"
                        }
                    }
                },
                rollno: {
                    required: true,
                    remote: {
                        url: "{{ route('project_leads.check_validitiy') }}",
                        type: "GET",
                        data: {
                            name: $("#txtRollNo").val(),
                            column_name: "rollno"
                        }
                    }
                },
                project_id: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "Leader Name is Required"
                },
                fname: {
                    required: "Father Name is Required"
                },
                project_id: {
                    required: "Please Provide Project ID"
                },
                rollno: {
                    required: "Roll No. is Required..",
                    remote: "This RollNo Is Already Exist.."
                },
                cnic: {
                    required: "CNIC is Required..",
                    remote: "CNIC Already Exist.."
                },
                contact_info: {
                    required: "Contact No. Is Required.."
                },
                address: {
                    required: "Please Provider Address.."
                },
                email: {
                    required: "Email Is Required..",
                    remote: "This Email Is Already Exist."
                }
            }
        });
    </script>
@endpush
