<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report from user</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-definitions.css') }}" rel="stylesheet">
    <style>
        .main-container{
            width: 100%;
            margin: auto;
            margin: 40px auto;
            padding-left: 40px;
            padding-right: 40px;
            max-width: 1360px;
        }
        footer {
        background-color: #333;
        overflow: hidden;
        margin-top: auto;
        }
        footer * {
        color: #fff;
        }
        footer a:hover {
        color: #fff;
        text-decoration: underline;
        }
        footer .footer-container {
        margin: 40px auto;
        display: flex;
        justify-content: space-between;
        }
        footer .footer-container .footer-col {
        width: 100%;
        max-width: 400px;
        }
        footer .footer-container .footer-col-2 {
        display: flex;
        max-width: 400px;
        width: 100%;
        justify-content: space-between;
        margin-left: 40px;
        }
        footer .footer-container .footer-col-2 .other-links {
        display: flex;
        flex-direction: column;
        gap: 5px;
        width: -moz-max-content;
        width: max-content;
        }
        footer .footer-container .footer-col-2 .other-links + .other-links {
        margin-left: 40px;
        }
        footer .home-link {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
        }
        footer .home-link h5, footer .home-link .h5 {
        margin-bottom: 0;
        }
        footer .home-link img {
        max-width: 40px;
        }
        footer .home-link span {
        white-space: nowrap;
        }

        @media screen and (max-width: 767px) {
        footer .footer-container {
            flex-direction: column;
            row-gap: 20px;
        }
        footer .footer-container .footer-col {
            max-width: unset;
        }
        footer .footer-container .footer-col-2 {
            margin-left: unset;
        }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <h1 class="fw-700">Vermilion Center</h1>
        <p>Dear Admin,</p>
        <p>There is a report form user, please consider to this report.</p>
        <p>Reason: {{$reason}}</p>
        <p>Message:</p>
        {!! $content !!}
        <p>View here: <a href="{{$url}}">{{$url}}</a></p>
        <p>Reporter: {{$user}}</p>
        <br>
        <p>Thanks!</p>
    </div>
</body>
</html>