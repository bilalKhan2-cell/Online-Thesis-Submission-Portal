@extends('layout.app')

@section('title')
    Manage Thesis
@endsection

@section('breadcrumbs')
    <x-breadcrumbs heading="Supervisor" subHeading="Thesis" page="Manage Thesis Approval" />
@endsection

@section('content')
    <div class="row">
        {!! InputField('s3', 'Enter Batch', ['id' => 'txtBatch'], 'number') !!}
        <button type="button" onclick="FetchThesis()" class="btn mt-3 blue">Submit</button>
        {!! ShowAlertMessage('warning', 'Please Wait While We Are Processing Your Request..') !!}
    </div>
    <br>
    <div class="row">
        <div class="col s12">
            {!! GenerateTable('tblThesis', 'table table-hover striped', [
                'Team ID',
                'Thesis Title',
                'Project Lead Name',
                'Roll No',
                'Thesis Status',
                'Action',
            ]) !!}
        </div>
    </div>
@endsection

@push('script')
    <script>
        $('.card-alert').hide();

        function FetchThesis() {
            let batch = $("#txtBatch").val()
            if (!isNaN(batch)) {
                if (!batch >= 2000) {
                    alert("Please Enter a Valid Year Value..")
                } else {
                    $.ajax({
                        url: "{{ route('supervisors.process_thesis') }}",
                        type: "GET",
                        data: {
                            batch: batch
                        },
                        success: function(response) {
                            console.table(response.result);
                            $(".card-alert").removeClass('blue').addClass("green");
                            $('.card-alert').show();
                            $('.card-alert').delay(2500).fadeOut();

                            $("#tblThesis > tbody").html(null);
                            if (response.result.length == 0) {
                                $("#tblThesis > tbody").html(
                                    '<tr><td colspan="7" style="text-align:center;">No Record(s) Found</td></tr>'
                                    );
                            } else {
                                response.result.forEach(resultItem => {
                                    $("#tblThesis > tbody").append(`
                                        <tr>
                                            <td>TEAM-${resultItem.team_id}</td>
                                            <td>${resultItem.thesis_title}</td>
                                            <td>${resultItem.team.name}</td>
                                            <td>${resultItem.team.rollno}</td>
                                            <td>${resultItem.status == 0 ? "<span class='purple-text'>Un-Processed</span>" : "<span class='red-text'>Reverted</span>"}</td>
                                            <td>
                                                <button class='btn cyan' type='submit'><i class='material-icons'>edit</i></button>
                                            </td>
                                        </tr>
                                    `);
                                });

                            }
                        }
                    });
                }

            } else {
                alert('The Value Must Be Numeric');
            }
        }
    </script>
@endpush
