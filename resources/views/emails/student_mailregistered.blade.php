<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Student Registration Successful</title>
</head>

<body>
    <h2>Welcome, {{ $student->full_name }}!</h2>
    <p>Your registration at GVJC has been successfully completed.</p>
    <p><strong>Registration Number:</strong> {{ $student->registration_number }}</p>
    <p><strong>your Email :</strong> {{ $student->email }}</p>
    <p><strong>your Password :</strong> 1234</p>

    <p>We're excited to have you join us!</p>
</body>

</html>
