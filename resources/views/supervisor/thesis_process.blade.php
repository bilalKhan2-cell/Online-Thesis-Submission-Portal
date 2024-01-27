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
        <div class="col s7">{{ $thesis_data->thesis_title }}</div>
    </div>
    <div class="row mt-2">
        <div class="col s3">Thesis File:</div>
        <div class="col s3">
            <a href="{{ asset('app/public/' . $file) }}" download>Thesis File</a>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col s3">Thesis Description: </div>
        <div class="col s9 word-wrap">{{ $thesis_data->thesis_description }}</div>
    </div>
    <br>
    <form action="{{ route('supervisors.submit_reviews', $thesis_data->id) }}" method="POST">
        @csrf
        <div class="row mt-1">
            <div class="col s12">
                <input type="text" name="comments" />
                @error('comments')
                    <span class="red-text">{{ $message }}</span>
                @enderror
            </div>
            <div class="col s4">
                <button type="submit" name="review" value="approve"
                    class="waves-effect waves-light  btn gradient-45deg-light-blue-cyan box-shadow-none border-round mr-1 mb-1">Approve</button>
                <button type="submit" name="review" value="revert"
                    class="waves-effect waves-light  btn gradient-45deg-red-pink box-shadow-none border-round mr-1 mb-1">Revert</button>
            </div>
        </div>
    </form>
@endsection
