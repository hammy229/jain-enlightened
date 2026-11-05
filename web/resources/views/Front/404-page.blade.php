<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jain Enlightened | Page Not Found</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            overflow: hidden;
            font-family: "Poppins", sans-serif;
        }
        .no-page-found-img{
            position: relative;
        }
        .no-page-found-img img{
            width: 100%;
            height: 100vh;
        }
        .back-btn {
            position: absolute;
            right: 38%;
            bottom: 25%;
            transform: translate(10%, 40%);
            padding: 15px 30px 12px 30px;
            background: #f6bf60;
            border-radius: 5px;
            font-size: 11px;
            text-transform: uppercase;
            text-decoration: none;
            font-weight: 700;
            color: #003b49;
            line-height: 1;
        }
    </style>

</head>
<body>
    <div class="no-page-found-img">
        <img src="{{URL::asset('front/images/default/405.jpg')}}" alt="404 No Page Found Image">
        <a href="{{URL::asset('/')}}" class="back-btn">Back To Home</a>
    </div>
</body>
</html>