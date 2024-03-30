<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>

<body>
    <p>Hello {{ $name }},</p>
    <p>Please click the following link to verify your email address:</p>
    <p><a href="{{ route('user.verify', ['id' => $id]) }}">Click Here</a></p>
    <p>If you didn't request this verification, you can ignore this email.</p>
</body>

</html>
