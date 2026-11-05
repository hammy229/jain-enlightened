<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mail</title>
    <style>
        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        }

        p {
            margin: 1rem 0;
            color: #222 !important;
        }
        h2 {
            color: #222 !important;
        }

        .social-media table th {
            padding: 0px 7px;
        }

        .title_icon {
            position: relative;
            padding: 0 10px;
            margin: 0 auto;
            display: table;
            line-height: normal;
        }

        .title_icon::before {
            content: "";
            background-color: #fff;
            position: absolute;
            width: 200px;
            height: 1px;
            display: block;
            top: 50%;
            left: -200px;
        }

        .title_icon::after {
            content: "";
            background-color: #fff;
            position: absolute;
            width: 200px;
            height: 1px;
            display: block;
            top: 50%;
            right: -200px;
        }

        .header {
            padding: 10px;
            background: linear-gradient(to Top, #ffffffde, #f6bf60);
            border-radius: 15px;
        }
    </style>
</head>

<body>
    <section style="max-width: 800px; height: auto; margin: 0px auto;">
        <header class="header">
            <div class="header-img" style="width: 100%; text-align: center; padding: 30px 0px; border: 1px solid #003b49de; border-radius: 15px">
                {{-- <img src="{{URL::asset('front/images/logo-new2.png')}}" alt="logo" style="width: 245px;"> --}}
                <img src="{{ asset('front/images/Mail-logo.png') }}" alt="logo" style="width: 245px;">
            </div>
        </header>
        <div class="container" style="text-align: center; margin: 0px 50px;">
            <h2 style="margin: 20px 0px;">Password Reset Request</h2>
            <div class="content" style="text-align: start; padding:20px; border: 1px solid #003b49de; border-radius: 15px">
                <p style="font-weight: 700;color:#222">Dear User,</p>
                <p style="color:#222">We received a request to reset your password. Please click the link below to reset it :</p>
                <p style="color:#222">Reset Password Link <b><a target="blank" href="{{ url('reset-password/'.$mailData['token']) }}" style="color:#222">Click Here</a></b></p>
                <p style="color:#222">If you didn’t request this, please ignore this email.</p>
            </div>
            <h2 style="margin: 20px 0px;">Thank you,</h2>
        </div>
        <footer class="footer" style="background: #003b49de; color: #fff; padding:20px 50px; text-align:center;">
            <div class="website-link"  style="padding: 15px 0px;">
                <a target="blank" href="{{ url('/') }}" style="color:#fff">www.jainenlightened.org</a>
            </div>
        </footer>
    </section>
</body>

</html>