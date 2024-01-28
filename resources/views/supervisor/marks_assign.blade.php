@extends('layout.app')

@section('title')
    Thesis Grading
@endsection

@section('breadcrumbs')
    <x-breadcrumbs heading="Supervisor" subHeading="Thesis" page="Manage Thesis Grading" />
@endsection

@section('content')
    <form action="{{ route('supervisors.fetch_marks') }}" method="POST">
        @csrf

        <div class="row">
            {!! InputField('s2', 'Enter Batch', ['name' => 'batch'], 'number') !!}
            {!! submitAndCancelButton('Submit', 'btn blue', 's4 mt-3') !!}
        </div>
        <br>
        @if (isset($result))
            <table class="table table-hover striped">
                <thead>
                    <tr>
                        <th>TEAM ID</th>
                        <th>Project Lead Name</th>
                        <th>Roll No</th>
                        <th>Thesis Title</th>
                        <th>Marks</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($result as $key => $value)
                        <tr>
                            <td>TEAM-{{ $value->team->id }}</td>
                            <td>{{ $value->team->name }}</td>
                            <td>{{ $value->team->rollno }}</td>
                            <td>{{ $value->thesis_title }}</td>
                            <td>
                                @if (is_null($value->marks))
                                    <span class="blue-text">Marks Not Assigned Yet.</span>
                                @else
                                    <span class="green-text">{{ $value->marks }} out of 200</span>
                                @endif
                            </td>
                            <td>
                                <a class="waves-effect waves-light btn modal-trigger" id="{{ $value->id }}"
                                    onclick="AssignMarks(this)" href="#modal1"><i class="material-icons">done</i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </form>

    <div id="modal1" class="modal modal-fixed-footer">
        <div class="modal-content">
            <h5 class="modal-header">Assign Marks</h5>
            <hr>
            <div class="row">
                <div class="col s3">
                    <div class="form-group">
                        <input type="hidden" name="id" id="txtAssignID" />
                        <label>Assign Marks: </label>
                        <input type="number" name="marks" id="txtMarks" />
                    </div>
                </div>
            </div>
                <button class="btn green" onclick="SubmitMarks()" id="btnSubmit">Submit</button>
            <span class="red-text mt-5" id="lblMessage"></span>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Close</a>
        </div>
    </div>
@endsection

@if (isset($result))
    @push('script')
        <script>
            $(document).ready(function(){
                $("table").DataTable();
                $("#btnSubmit").hide();
            });

            function AssignMarks(assign_id) {
                let id = assign_id.id;
                localStorage.setItem('assign_id',id);
                let assign_marks_status = true;
                $("#txtAssignId").val(id);
                $("#txtMarks").addClass('mt-4');
                $("#lblMessage").addClass('mt-4')
                {
                    $.ajax({
                        url: "{{ route('supervisors.get_marks') }}",
                        type: "GET",
                        data: {
                            id: id
                        },
                        success: function(response) {
                            $("#txtMarks").val(response.result.marks);

                            if (response.result.is_marks_edit_allowed < 2) {
                                assign_marks_status = true;
                                $("#btnSubmit").show();
                            } else {
                                assign_marks_status = false;
                                $("#btnSubmit").hide();
                                $("#lblMessage").html("Marks Can Not Be Edit Again.");
                            }
                        }
                    })
                }
            }

            function SubmitMarks() {
                let assign_id = $("#txtAssignID").val();
                let marks = $("#txtMarks").val();

                if ($("#txtMarks").val() == '') {
                    alert("Marks Are Required..");
                } else if($("#txtMarks").val()>200){
                    alert("Marks Should Be Less Or Equal to 200..")
                } else {

                    $.ajax({
                        url: "{{ route('supervisors.submit_marks') }}",
                        type: "POST",
                        data: {
                            marks: marks,
                            id:localStorage.getItem('assign_id'),
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.success == 0) {
                                alert("Marks Can Not Be Updated Now!..");
                            } else {
                                alert("Marks Update Successfully..");
                                setTimeout(() => {
                                    window.location.href = "{{ route('supervisors.thesis_grading') }}";
                                }, 2000);
                            }
                        }
                    });
                }
            }
        </script>
    @endpush
@endif
