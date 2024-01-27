@extends('layout.app')

@section('title')
    Thesis Status
@endsection

@section('breadcrumbs')
    <x-breadcrumbs heading="Supervisor" subHeading="Thesis" page="Manage Thesis Status" />
@endsection

@section('content')
    <style>
        .word-wrap {
            word-wrap: break-word;
        }
    </style>
    <div class="row">
        <div class="col s3">Thesis Title: </div>
        <div class="col s3">{{ $thesis_data->thesis_title }}</div>
    </div>
    <div class="row mt-2">
        <div class="col s3">Thesis File:</div>
        <div class="col s3"><a href="{{ $file }}" download>Thesis File</a></div>
    </div>
    <div class="row mt-2">
        <div class="col s3">Thesis Description: </div>
        <div class="col s9 word-wrap">{{ $thesis_data->thesis_description }}</div>
    </div>
@endsection
