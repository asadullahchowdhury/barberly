<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">
</head>
<body style="margin: 10px; padding: 0; box-sizing: border-box; font-family: 'Lato', sans-serif;">

<div
    style="max-width: 600px; height: auto; background-color: #fff; margin: 0 auto; border-radius: 20px;border: 1px solid #eee;text-align: center;">
    <div style="padding: 25px;">

        <div style="width: 100%; height: auto; text-align: center;">
            <img src="{{asset('/images/email/jpg/logo-name.jpg')}}" style="width: 200px; height: auto;" alt="logo">
        </div>

        <br>
        <br>

        <div style="font-weight: bold; font-size: 23px;color: #000;">
            Hi {{$user->first_name}}, Please verify your email address
        </div>
        <br>
        <div style="font-weight: normal; font-size: 16px;color: #000;">
            To keep your account secure we need to check that the email address

            <a style="text-decoration: none; color: #4AC1C0;">{{$user->email}} </a>

            belongs to you. You'll only need to do this once.
        </div>
        <br><br>
        <div style="font-size:45px;letter-spacing:10px;font-weight: bold;">
            <h3>{{$user->otp}}</h3>
        </div>
        <br><br>
        <div style="font-weight: bold; font-size: 20px;color: #000;">Why did i receive this?</div>
        <br>
        <div style="font-weight: normal; font-size: 16px;color: #000;">
            Your email address was entered on <span style="background-color: #FFFB73; margin: 0 5px"> BARBERLY </span>
            to be used for login access. If you have received this
            message by mistake simply contact us

            <a href="javascript:void(0)" style="text-decoration: none; color: #4AC1C0;">click here</a>

            to let us know.
        </div>
    </div>
</div>


</body>
</html>
