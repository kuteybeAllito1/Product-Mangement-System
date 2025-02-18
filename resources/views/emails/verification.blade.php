<!DOCTYPE html>
<html>
<head>
    <title>Your Verification Code</title>
</head>
<body>
    <h2>Hello {{ $user->name }}</h2>
    <p>Your verification code is: <strong>{{ $user->verification_code }}</strong></p>
    <p>Please use this code on the login page to verify your account.</p>
    <br>
    <p>If you did not sign up, please ignore this email.</p>
</body>
</html>
