@extends('layout.app')

@section('title')
    Manage Supervisors
@endsection

@section('breadcrumbs')
    <x-breadcrumbs heading="Supervisor" subHeading="Manage Supervisors" page="Update User" />
@endsection

@section('content')
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            {!! InputField('s4', 'Usernanme', ['name' => 'name', 'value' => $user->name], 'text') !!}

            {!! InputField('s4', 'Email', ['name' => 'email', 'readonly' => '', 'value' => $user->email], 'email') !!}

            {!! StaticSelectField('s4', 'Select Gender', 'gender', $genders) !!}
        </div>

        <div class="row mt-2">
            {!! InputField(
                's4',
                'Contact Info',
                ['name' => 'contact_info', 'value' => $user->contact_info, 'id' => 'txtContactInfo'],
                'text',
            ) !!}

            {!! InputField(
                's4',
                'CNIC No.',
                ['name' => 'cnic', 'value' => $user->cnic, 'id' => 'txtCNIC', 'readonly' => 'true'],
                'text',
            ) !!}

            {!! InputField('s12', 'Address', ['name' => 'address', 'value' => $user->address], 'text') !!}

            {!! submitAndCancelButton('Update', 'btn blue', 's3') !!}
        </div>
    </form>
@endsection
