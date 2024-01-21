@extends('layout.app')

@section('title')
    Create User
@endsection

@section('breadcrumbs')
    <x-breadcrumbs heading="User" subHeading="Manage Users" page="User Registration Form" />
@endsection

@section('content')
    <form action="{{ route('users.store') }}" id="frmUsers" method="POST">
        @csrf
        <div class="row">
            {!! InputField('s4','Usernanme',['name' => "name"],'text') !!}

            {!! InputField('s4',"Email",['name' => "email"],'email') !!}

            {!! StaticSelectField('s4','Select Gender','gender',$genders) !!}
        </div>

        <div class="row mt-2">
            {!! InputField('s4','Contact Info',['name' => "contact_info",'id' => "txtContactInfo"],'text') !!}

            {!! InputField('s4','CNIC No.',['name' => 'cnic','id' => "txtCNIC"],'text') !!}

            {!! InputField('s12','Address',['name' => "address"],'text') !!}

            {!! submitAndCancelButton('Save','btn green','s3') !!}
        </div>
    </form>
@endsection

@push('script')
    <script>
        $("#txtContactInfo").formatter({
            pattern:"@{{9999}}-@{{9999999}}",
            persistent:true
        });

        $("#txtCNIC").formatter({
            pattern:"@{{99999}}-@{{9999999}}-@{{9}}",
            persistent:true
        });
    </script>

    <script src="{{asset('app-assets/js/scripts/user-form-validation.js')}}"></script>
@endpush