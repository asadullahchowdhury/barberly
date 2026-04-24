<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body >

<p>You have requested to register an account at Barberly.<br>
    <br>
    <br>
    To activate this account, please click the following link within the next 10 days:<br>

    <a href="{{env('APP_URL')}}/activation/{{$user->verified_token}}">
        {{env('APP_URL')}}/activation/{{$user->verified_token}}
    </a>

    <br>
    <br>
    Greetings from the technical staff of Sign Me In platform
    <br>
    Mybos Support
</p>

</body>
</html>
