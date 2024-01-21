@extends('layout.app')

@section('title')
    Manage Supervisors
@endsection

@section('breadcrumbs')
    <x-breadcrumbs heading="Supervisor" subHeading="Manage Supervisors" page="Register Supervisiors" />
@endsection

@section('content')
    <form action="{{ route('supervisors.update', $data->id) }}" method="POST" id="frmSupervisor">
        @csrf
        @method('PUT')
        <div class="row">
            {!! InputField('s4', 'Name', ['name' => 'name', 'value' => $data->name, 'id' => 'txtSupervisorName'], 'text') !!}

            {!! InputField('s4', 'Father Name', ['name' => 'fname', 'value' => $data->fname, 'id' => ''], 'text') !!}

            {!! InputField(
                's3',
                'Email',
                [
                    'name' => 'email',
                    'id' => 'txtSupervisorEmail',
                    'value' => $data->email,
                ],
                'email',
                $data->status==1 ? false :true
            ) !!}

            {!! StaticSelectField('s3', 'Select Gender', 'gender', $genders, $data->gender) !!}

            {!! InputField(
                's3',
                'Contact Info',
                ['name' => 'contact_info', 'value' => $data->contact_info, 'id' => 'txtSupervisorContactInfo'],
                'text',
                true
            ) !!}

            {!! InputField(
                's3',
                'CNIC No.',
                [
                    'name' => 'cnic',
                    'value' => $data->cnic,
                    'id' => 'txtSupervisorCNIC',
                ],
                'text',
                $data->status==0 ? true :false
            ) !!}

            {!! SelectField('s3', 'Select Department', 'department', $department_list, $data->department_id) !!}

            {!! InputField('s12', 'Address', ['name' => 'address', 'value' => $data->address], 'text') !!}

            {!! submitAndCancelButton('Submit', 'btn blue', 's4') !!}
        </div>
    </form>
@endsection

@push('script')
    <script src="{{ asset('app-assets/js/scripts/supervisor-form-validation.js') }}"></script>
@endpush
