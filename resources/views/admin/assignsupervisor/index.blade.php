@extends('layout.app')

@section('title')
    Assign Supervisor
@endsection

@section('breadcrumbs')
    <x-breadcrumbs heading="Assign Supervisor" subHeading="Manage Supervisor Assigning" page="List of Assigned Supervisors" />
@endsection

@section('content')
    @if (session()->has('success'))
        {!! ShowAlertMessage('green', session()->get('success')) !!}
    @endif

    <form id="frmData" action="{{ route('assign_supervisor.details') }}" method="POST">
        @csrf
        <div class="row">
            {!! SelectField('s4', 'Select Department', 'department', $department_list) !!}
            {!! InputField('s3', 'Enter Batch', ['name' => 'batch', 'id' => 'txtBatch', 'value' => old('batch')], 'number') !!}
            {!! submitAndCancelButton('Submit', 'btn blue mt-', 'mt-2 s4') !!}
        </div>
    </form>

    @error('batch')
        <span class="red-text">{{ $message }}</span>
    @enderror

    <br>
    @if (isset($assigning_supervisors_details))
        <table class="table table-hover striped">
            <thead>
                <tr>
                    <th>TEAM ID</th>
                    <th>Project Lead Name</th>
                    <th>Email</th>
                    <th>Roll No</th>
                    <th>Assigned Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($assigning_supervisors_details as $key => $value)
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->name }} </td>
                        <td>{{ $value->email }}</td>
                        <td>{{ $value->rollno }}</td>
                        <td>{!! $value->assign_supervisor == null
                            ? "<span class='new badge warning'>Not Assigned</span>"
                            : "<span class='new badge blue'>Assigned</span>" !!}</td>
                        <td>
                            <a href="{{ route('assign_supervisor.create', $value->id) }}" class="btn green"><i
                                    class="material-icons">assignment_add</i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

@endsection

@push('script')
    <script></script>
@endpush
