@extends('layout.app')

@section('title')
    Departments
@endsection

@section('breadcrumbs')
    <x-breadcrumbs heading="Department" subHeading="Manage Department" page="List of Departments" />
@endsection

@section('content')
    <div class="row">
        <form action="{{ route('departments.update',$data->id) }}" method="POST">
            @csrf
            @method('PUT')
            {!! InputField('s3', 'Name', ['name' => 'name'], 'text',$data->name) !!}

            {!! InputField('s6', 'Comments (if any):', ['name' => 'comments'], 'text',$data->description) !!}

            {!! submitAndCancelButton('Save', 'btn green', 's3 mt-3') !!}
        </form>
    </div>
@endsection