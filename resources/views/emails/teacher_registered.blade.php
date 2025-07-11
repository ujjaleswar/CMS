<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Teacher Registration Successful</title>
</head>

<body>
    <h2>Welcome, {{ $teacher->name }}!</h2>
    <p>Your registration as a teacher at GVJC has been successfully completed.</p>
    <p><strong>your Email :</strong> {{ $teacher->email }}</p>
    <p><strong>your Password :</strong> 1234</p>
    <p>We're excited to have you join our faculty team!</p>

</body>

</html>
