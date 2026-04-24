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

        <div style="max-width: 650px; height: auto; padding: 40px;margin:0 auto;text-align: center;border: 1px solid #eee;border-radius: 20px;">
            <div style="width: 100%; height: auto; text-align: center;">
                <img src="{{asset('/images/email/jpg/logo-name.jpg')}}" style="width: 200px; height: auto;"
                     alt="logo-name">
            </div>
            <br><br>
            <div style="font-weight: bold; font-size: 23px;color: #000;">Reset your password</div>
            <br><br>
            <div style="color: #000;">
                You've requested a link to change your password. In order to reset your password,
                click the button below.
            </div>
            <br><br>
            <div style="font-weight: bold; text-align: center;">
                <a href="{{route('change.password',['token' => $user->reset_code])}}" style="text-decoration: none; color: #ffffff; background-color: #000000; display: inline-block; padding: 12px 20px; border-radius: 5px;">
                    Change Password
                </a>
            </div>
            <br><br>
            <div style="color: #000;">
                If you didn't request this, please ignore this email. Your password won't change until you access the
                link above and create a new one.
            </div>
            <br><br>
            <div style="width: 100%; height: auto; text-align: center; opacity: 0.5;">
                <img src="{{asset('/images/email/jpg/logo-name.jpg')}}" style="width: 200px; height: auto;" alt="logo">
            </div>
            <br><br>
            <div style="font-weight: normal; font-size: 16px; text-align: center;color: #000;">
                The world's largest, top-rated booking platform form beauty and wellness, trusted by millions worldwide. unlimited possibilities, subscription-free
            </div>
            <div style="margin: 30px 0">
                <a href="javascript:void(0)" style="display:inline-block;margin: 0 10px;">
                    <img src="{{asset('/images/email/jpg/facebook.jpg')}}" style="width: 30px; height: 30px;" alt="facebook">
                </a>
                <a href="javascript:void(0)" style="display:inline-block;margin: 0 10px;">
                    <img src="{{asset('/images/email/jpg/instagram.jpg')}}" style="width: 30px; height: 30px;" alt="instagram">
                </a>
                <a href="javascript:void(0)" style="display:inline-block;margin: 0 10px;">
                    <img src="{{asset('/images/email/jpg/linkedin.jpg')}}" style="width: 30px; height: 30px;" alt="linkedin">
                </a>
            </div>
            <hr>
            <div style="margin: 20px 0;text-align: center">
                <div style="display:inline-block;padding: 10px 0;margin-right: 20px;color: #000;font-size: 16px">
                    Top rated 5/5
                </div>
                <div style="display: inline-block;vertical-align:middle; padding: 10px 0">
                    <img src="{{asset('/images/email/jpg/star.jpg')}}" style="width: 30px; height: 30px;" alt="star">
                    <img src="{{asset('/images/email/jpg/star.jpg')}}" style="width: 30px; height: 30px;" alt="star">
                    <img src="{{asset('/images/email/jpg/star.jpg')}}" style="width: 30px; height: 30px;" alt="star">
                    <img src="{{asset('/images/email/jpg/star.jpg')}}" style="width: 30px; height: 30px;" alt="star">
                    <img src="{{asset('/images/email/jpg/star.jpg')}}" style="width: 30px; height: 30px;" alt="star">
                </div>
            </div>
            <div style="width: 100%; height: auto; text-align: center;">
                <img src="{{asset('/images/email/jpg/logo.jpg')}}" style="width: 200px; height: auto;" alt="logo">
            </div>
            <br>
            <div style="text-align: center">
                <div style="color: #6c757d;">
                    @2023 Barberly
                    <br><br>
                        10 York Road, London, United Kingdom
                    <br><br>
                        You're receiving this email as you created an account with Barberly
                    <br><br>
                </div>
            </div>
        </div>

</body>
</html>
