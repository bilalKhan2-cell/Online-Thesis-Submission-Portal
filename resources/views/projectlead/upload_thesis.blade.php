@extends('layout.app')

@section('title')
    Upload Thesis
@endsection

@section('breadcrumbs')
    <x-breadcrumbs heading="Dashboard" subHeading="Project Lead" page="Upload Thesis" />
@endsection

@section('content')
    
    @if(session()->has('invalid_file_error'))
        {!! ShowAlertMessage('red',session()->get('invalid_file_error')) !!}
    @endif
    
    <form action="{{ route('team.upload_thesis') }}" id="frmThesis" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col s6">
                <label>Thesis Title: </label>
                <input type="text" name="thesis_title" />
            </div>
        </div>

        <div class="row mt-1">
            {!! TextArea('s12', 'Thesis Description', ['name' => 'thesis_description'], 'materialize-textarea', isset($thesis_data->thesis_description) ? $thesis_data->thesis_description : "") !!}

            {!! InputField('s4', 'Thesis File', ['name' => 'thesis_file'], 'file') !!}

            @if ($status==false)
                {!! submitAndCancelButton('Upload', 'btn blue', 's4') !!}
            @endif
        </div>
    </form>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#frmThesis').validate({
                rules: {
                    thesis_title: {
                        required: true
                    },
                    thesis_description: {
                        required: true
                    },
                    thesis_file: {
                        required: true,
                        extension:"pdf|doc|docx"
                    }
                },
                messages: {
                    thesis_title: {
                        required: "Please Provide a thesis Title",
                    },
                    thesis_description: {
                        required: "Thesis Description is Mandatory.."
                    },
                    thesis_file: {
                        required: "Please Upload Your Thesis File.",
                        extension:"Only MS Doc Docx and PDF File Allowed"
                    }
                }
            });
        });
    </script>
@endpush
