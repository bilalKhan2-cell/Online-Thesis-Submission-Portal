@extends('layout.app')

@section('title')
    Update Project Lead
@endsection

@section('breadcrumbs')
    <x-breadcrumbs heading="Project Lead" subHeading="Manage Project Lead Data" page="Update Project Lead" />
@endsection

@section('content')
    @extends('layout.app')

@section('title')
    Edit Project Lead Details
@endsection

@section('breadcrumbs')
    <x-breadcrumbs heading="Project Lead" subHeading="Manage Project Lead Data" page="Register Project Lead" />
@endsection

@section('content')
    <form action="{{ route('project_leads.update', $data->id) }}" method="POST" id="frmProjectLead">
        @csrf
        <div class="row">
            {!! InputField('s3', 'Project ID', ['name' => 'project_id', 'value' => $data->project_id], 'text') !!}
        </div>

        <div class="row mt-2">
            {!! InputField('s4', 'Project Lead Name', ['name' => 'name', 'value' => $data->name], 'text') !!}

            {!! InputField('s4', 'Father Name', ['name' => 'fname', 'value' => $data->fname], 'text') !!}

            {!! StaticSelectField('s4', 'Select Gender', 'gender', $genders) !!}
        </div>

        <div class="row mt-2">
            {!! InputField('s4', 'Email', ['name' => 'email', 'value' => $data->email], 'email') !!}

            {!! InputField('s4', 'Roll No.', ['name' => 'rollno', 'value' => $data->rollno], 'text') !!}

            {!! InputField(
                's4',
                'Contact Info',
                ['name' => 'contact_info', 'id' => 'txtContactInfo', 'value' => $data->contact_info],
                'text',
            ) !!}

            {!! InputField('s4', 'CNIC No.', ['name' => 'cnic', 'id' => 'txtCNIC', 'value' => $data->cnic], 'text') !!}

            {!! SelectField('s4', 'Select Department', 'department', $departments, $$data->department->id) !!}

            {!! InputField(
                's12',
                'Address.',
                ['name' => 'address', 'id' => 'txtAddress', 'value' => $data->address],
                'text',
            ) !!}

            {!! submitAndCancelButton('Update', 'btn blue', 's4') !!}

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
                    required: true
                },
                email: {
                    required: true,
                },
                rollno: {
                    required: true,
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
                    required: "Roll No. is Required.."
                },
                cnic: {
                    required: "CNIC is Required.."
                },
                contact_info: {
                    required: "Contact No. Is Required.."
                },
                address: {
                    required: "Please Provider Address.."
                }
            }
        });
    </script>
@endpush
