{{-- @extends('Admin.Layouts.mail_layout') --}}

{{-- @section('mail_title')  Change Password  @endsection --}}

{{-- @section('email_content') --}}
<!DOCTYPE html>
<html>
<head>
    {{-- <title>@yield('mail_title')</title> --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type="text/css">
        body {
            font-family: 'Poppins', sans-serif;
            color: #444444;
        }
        .social-links a img{
            height: 25px;
        }
        .header {
            padding: 10px;
            background: linear-gradient(to right, #BDCAC5, #E2EBE7);
            border-radius: 0px 0px 15px 15px;
            margin: 0px 50px;
        }
    </style>
    {{-- @yield('email_css') --}}
</head>
<body style="background: #f1f1f1; margin: 0px auto; padding: 0px;font-family: 'Poppins', sans-serif;overflow: hidden;">
        <div class="header-logo" style="width: 100%;padding: 10px 40px;background: #3284f547;">
            {{-- <img src="{{ !empty($logo_image->logo_email_image_path) && Storage::exists($logo_image->logo_email_image_path) ? url('/').Storage::url($logo_image->logo_email_image_path) : URL::asset('admin_panel/commonarea/dist/img/default.png') }}" alt="{{ !empty($logo_image->logo_email_image_name) ? $logo_image->logo_image_name : 'Logo Image' }}" style="max-width: 160px; max-height: 160px;"> --}}
            <img src="{{ asset('front/images/Mail-logo.png') }}" alt="" style="max-width: 160px; max-height: 160px;">
        </div>
        <div style="padding:40px 40px 3px">
            
            <div style="width:100%;display:block;margin-bottom:10px">
                <p>Hi User,</p>
                <p>We received a request to reset your password. Please click the link below to reset it:</p>
                <a href="{{ url('reset-password/'.$mailData['token']) }}">Click Here</a>
                <p>If you didn’t request this, please ignore this email.</p>
                <p>Thank you,</p>
            </div>
            {{-- <div style="width:100%;margin-bottom:30px">
                <div style="font-size:16px;color:#000">
                    <h3>
                        <p><a href="{{ url('reset-password/'.$mailData['token']) }}">Click Here</a> to change the password</p>
                    </h3>
                </div>
            </div> --}}
        </div>
        <div style="width: 100%;background: #3284f547;background-repeat: no-repeat;height: auto;padding-left: 40px;">
            <table style="width: 100%; align-items: middle">
                <tr>
                    <td style="padding: 15px 0px;">
                        <div class="website-link">
                            <a target="blank" href="{{ url('/') }}">www.jainenlightened.org</a>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
</body>
</html>