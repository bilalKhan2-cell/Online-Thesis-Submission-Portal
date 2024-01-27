@extends('layout.app')

@section('title')
    Thesis Approval Status
@endsection

@section('breadcrumbs')
    <x-breadcrumbs heading="Dashboard" subHeading="Project Lead" page="Profile" />
@endsection

@section('content')
    <div class="row">
        <div class="col s12">
            <table class="table table-hover striped">
                <thead>
                    <tr>
                        <th>Thesis Title</th>
                        <th>Thesis File</th>
                        <th>Approval Status</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!is_null($thesis))
                        <tr>
                            <td>{{ $thesis->thesis_title }}</td>
                            <td><a href="{{ public_path($thesis->thesis_file) }}" download>Thesis File</a></td>
                            <td>
                                @if (is_null($thesis->status))
                                    <span class="purple-text">Thesis Submission Pending</span>
                                @elseif($thesis->status == 0)
                                    <span class="blue-text">Thesis Status Pending From Supervisor</span>
                                @elseif($thesis->status == 1)
                                    <span class="red-text">Thesis Reverted From Supervisor</span>
                                @else
                                    <span class="green-text">Thesis Approved</span>
                                @endif
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="6" class="text-center">Supervisor Not Assigned Yet..</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <br>
            @if (!is_null($thesis))
                @if ($thesis->status == 1)
                    <div class="row">
                        <div class="col s12 input-field">
                            <i class="material-icons prefix">edit</i>
                            <input id="name3" type="text" readonly value="{{ $thesis->supervisor_comments }}" />
                            <label for="name3">Comments:</label>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection
