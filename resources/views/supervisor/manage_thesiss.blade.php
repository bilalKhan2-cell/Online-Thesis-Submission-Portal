@extends('layout.app')

@section('title')
    Manage Thesis
@endsection

@section('breadcrumbs')
    <x-breadcrumbs heading="Supervisor" subHeading="Thesis" page="Manage Thesis Approval" />
@endsection

@section('content')
    @if (session()->has('review_success'))
        {!! ShowAlertMessage('green', session()->get('review_success')) !!}
    @endif

    <form action="{{ route('supervisors.manage_thesis_status') }}" method="POST">
        @csrf
        <div class="row">
            {!! InputField('s3', 'Enter Batch', ['id' => 'txtBatch', 'name' => 'batch'], 'number') !!}
            <button type="submit" class="btn mt-3 blue">Submit</button>
        </div>
    </form>

    @if (isset($details) || !count($details)==0)
        <br>
        <div class="row">
            <div class="col s12">
                <table class="table table-hover striped" id="tblThesis">
                    <thead>
                        <tr>
                            <td>Team ID</td>
                            <th>Thesis Title</th>
                            <th>Project Lead Name</th>
                            <th>Roll No</th>
                            <th>Thesis Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($details as $key => $value)
                            <tr>
                                <td>TEAM-{{ $value->team->id }}</td>
                                <td>{{ $value->thesis_title }}</td>
                                <td>{{ $value->team->name }}</td>
                                <td>{{ $value->team->rollno }}</td>
                                <td>
                                    @if(is_null($value->thesis_title))
                                        <span class="red-text">Thesis Not Uploaded Yet.</span>
                                    @elseif ($value->status == 1)
                                        <span class="red-text">Reverted</span>
                                    @elseif(!is_null($value->thesis_title) && $value->status==0)
                                        <span class="red-text">Un-Processed</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($value->status == 0)
                                        <a href="{{ route('supervisors.review_thesis', $value->id) }}"><i
                                                class="material-icons">edit</i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection

@push('script')
    <script>
        @if (isset($details))
            $('.table').DataTable();
        @endif
    </script>
@endpush
