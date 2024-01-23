<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Project Lead Registration</title>
</head>
<body>
    Dear <b>{{ $project_lead->name }}</b>
    <br><br>
    Your Thesis Management Account Have Created Successfully..
    <br><br>
    Your Account Password is <b>{{ $password }}</b>
    <br><br>
    Your Account Details
    <br><br>
    <table border="2">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Contact Info</th>
                <th>CNIC</th>
                <th>Department</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $project_lead->name }}</td>
                <td>{{ $project_lead->email }}</td>
                <td>{{ $project_lead->contact_info }}</td>
                <td>{{ $project_lead->cnic }}</td>
                <td>{{ $project_lead->department->name }}</td>
            </tr>
        </tbody>
    </table>

</body>
</html>