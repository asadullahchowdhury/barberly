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
    style="max-width: 600px; height: auto; background-color: #fff; border-radius: 20px;border: 1px solid #eee;text-align: center;margin: 0 auto">
    <div style="padding: 25px;">
        <div style="width: 100%; height: auto; text-align: center; margin-bottom: 32px;">
            <img src="{{asset('/images/email/jpg/logo.jpg')}}" style="width: 200px; height: auto;" alt="logo">
        </div>
        <div style="font-weight: bold; font-size: 23px; margin-bottom: 16px; text-transform: capitalize;color:#000;">
            Hello {{$user['first_name']}},
        </div>
        <div style="font-weight: normal; font-size: 16px; margin-bottom: 16px;">
            <span
                style="text-transform: capitalize; margin-right: 10px;color:#000;">{{$sentFrom['first_name']}}</span> {{$sentFrom['end_name']}}
            <span style="color: #000">has invited you to Barberly.</span>
        </div>
        <div style="font-weight: normal; font-size: 16px; margin-bottom: 16px;color:#000;">
            <b>Email:</b> <span style="color: #4AC1C0;text-decoration: none;">{{$user['email']}}</span>
        </div>
        <div style="font-weight: normal; font-size: 16px; margin-bottom: 16px;color:#000;">
            <b>Password:</b> {{$user['password']}}
        </div>
        <div style="font-weight: normal; font-size: 16px; margin-bottom: 16px;color:#000;">
            Click on the link below to login
        </div>
        <div style="margin-bottom: 16px;">
            <a href="{{route('lvs.auth.customer.any',['any' => 'sign-in'])}}"
               style="color: #4AC1C0; text-decoration: none;">
                {{route('lvs.auth.customer.any',['any' => 'sign-in'])}}
            </a>
        </div>
        <div style="font-weight: bold; font-size: 20px; margin-bottom: 16px;color:#000;">
            Why did i receive this?
        </div>
        <footer style="font-weight: normal; font-size: 16px;color:#000;">
            Your email address was entered on
            <span style="background-color: #FFFB73; margin: 0 5px">
                    BARBERLY
                </span>
            to be used for login access. If you have received this
            message by mistake simply contact us
            <a href="javascript:void(0)" style="text-decoration: none; color: #4AC1C0;">
                click here
            </a>
            to let us know.
        </footer>
    </div>
</div>

</body>
</html>
