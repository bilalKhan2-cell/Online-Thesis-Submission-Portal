@extends('layout.app')

@section('title')
    Manage Supervisors
@endsection

@section('breadcrumbs')
    <x-breadcrumbs heading="Supervisor" subHeading="Manage Supervisors" page="Register Supervisiors" />
@endsection

@section('content')
    <form action="{{ route('supervisors.store') }}" method="POST" id="frmSupervisor">
        @csrf
        <div class="row">
            {!! InputField('s4', 'Name', ['name' => 'name', 'id' => 'txtSupervisorName'], 'text') !!}

            {!! InputField('s4', 'Father Name', ['name' => 'fname', 'id' => ''], 'text') !!}

            {!! InputField('s3', 'Email', ['name' => 'email', 'id' => 'txtSupervisorEmail'], 'email') !!}

            {!! StaticSelectField('s3', 'Select Gender', 'gender', $genders) !!}

            {!! InputField('s3', 'Contact Info', ['name' => 'contact_info', 'id' => 'txtSupervisorContactInfo'], 'text') !!}

            {!! InputField('s3', 'CNIC No.', ['name' => 'cnic', 'id' => 'txtSupervisorCNIC'], 'text') !!}

            {!! SelectField('s3', 'Select Department', 'department', $department_list) !!}

            {!! InputField('s12', 'Address', ['name' => 'address'], 'text') !!}

            {!! submitAndCancelButton('Submit', 'btn green', 's4') !!}
        </div>
    </form>
@endsection

@push('script')
    <script src="{{ asset('app-assets/js/scripts/supervisor-form-validation.js') }}"></script>
@endpush
