<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Supervisor Registration</title>
</head>

<body>
    Dear <b>{{ $supervisor->name }}</b>
    <br><br>
    Your Supervisor Account Have Created Successfully..
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
                <td>{{ $supervisor->name }}</td>
                <td>{{ $supervisor->email }}</td>
                <td>{{ $supervisor->contact_info }}</td>
                <td>{{ $supervisor->cnic }}</td>
                <td>{{ $supervisor->department->name }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
