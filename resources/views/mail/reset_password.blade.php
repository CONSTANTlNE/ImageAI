<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
{{--<p>You are receiving this email because we received a password reset request for your account.</p>--}}

<a href="{{ $url }}">Reset Password</a>

<p>This password reset link will expire in {{ $expire }} minutes.</p>

<p>If you did not request a password reset, no further action is required.</p>
</body>
</html>