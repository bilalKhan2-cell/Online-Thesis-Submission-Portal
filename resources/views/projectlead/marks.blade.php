@extends('layout.app')

@section('title')
    Thesis Grade
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
                        <th>Team ID</th>
                        <th>Thesis Title</th>
                        <th>Marks</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>TEAM-{{$thesis_details->team_id}}</td>
                        <td>{{$thesis_details->thesis_title}}</td>
                        <td>
                            @if($status==0)
                                <span class='red-text'>Your Thesis Is Still In Approval Process</span>
                            @elseif($status==2)
                                <span class='blue-text'>Your Thesis Is Approved But Marks Assigning Is Still In Process</span>
                            @else 
                                <span class='green-text'>{{ $thesis_details->marks }} out of 200</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
