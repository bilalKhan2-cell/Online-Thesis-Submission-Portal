<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Registration</title>
</head>

<body>
    Dear <b>{{ $user->name }}</b>
    <br><br>
    Your System User Account Have Created Successfully..
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
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->contact_info }}</td>
                <td>{{ $user->cnic }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
