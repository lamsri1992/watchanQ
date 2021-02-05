<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Watchan Smart Hospital</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@200;300&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Prompt', sans-serif;
        }

        .full-height {
            height: 30vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 16px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                Watchan Smart Hospital
            </div>
            <div class="links">
                <a href="/monitor/er">ห้องฉุกเฉิน</a>
                <a href="/monitor/opd">ผู้ป่วยนอก</a>
                <a href="/monitor/pcu">คลินิก PCU</a>
                <a href="/caller/opd">เรียกคิวผู้ป่วยนอก</a>
            </div>
        </div>
    </div>
</body>

</html>
