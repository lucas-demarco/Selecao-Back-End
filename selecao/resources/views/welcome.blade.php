<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="css/estilo_base.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <style>
        html {
            line-height: 1.15;
            -webkit-text-size-adjust: 100%
        }

        body {
            margin: 0;
            font-family: 'Nunito', sans-serif;

        }

        #div_products {
            background: rgba(0, 0, 0, 0.5);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 18px 6px rgba(127, 128, 201, 0.7);
        }

        .row_cards {
            display: flex;
            justify-content: space-between;
        }

        .cards {
            background: white;
            border-radius: 30px;
            width: 20%;
            position: relative;
            float: left;
        }

        h2 {
            color: #000;
            font-size: 26px;
            font-weight: 300;
            text-align: center;
            text-transform: uppercase;
            position: relative;
            margin: 30px 0 80px;
        }

        h2 b {
            color: #ffc000;
        }

        h2::after {
            content: "";
            width: 100px;
            position: absolute;
            margin: 0 auto;
            height: 4px;
            background: rgba(0, 0, 0, 0.2);
            left: 0;
            right: 0;
            bottom: -20px;
        }

        .item {
            min-height: 330px;
            text-align: center;
            overflow: hidden;
        }

        .item .img-box {
            height: 160px;
            width: 100%;
            position: relative;
        }

        .item img {
            max-width: 100%;
            max-height: 100%;
            display: inline-block;
            position: absolute;
            bottom: 0;
            margin: 0 auto;
            left: 0;
            right: 0;
        }

        .item h4 {
            font-size: 18px;
            margin: 10px 0;
        }

        .item .btn {
            color: #333;
            border-radius: 0;
            font-size: 11px;
            text-transform: uppercase;
            font-weight: bold;
            background: none;
            border: 1px solid #ccc;
            padding: 5px 10px;
            margin-top: 5px;
            line-height: 16px;
        }

        .item .btn:hover,
        .item .btn:focus {
            color: #fff;
            background: #000;
            border-color: #000;
            box-shadow: none;
        }

        .item .btn i {
            font-size: 14px;
            font-weight: bold;
            margin-left: 5px;
        }

        .thumb-wrapper {
            text-align: center;
        }

        .thumb-content {
            padding: 15px;
        }

        .item-price {
            font-size: 13px;
            padding: 2px 0;
        }

        .item-price strike {
            color: #999;
            margin-right: 5px;
        }

        .item-price span {
            color: #86bd57;
            font-size: 110%;
        }
    </style>
</head>

<body class="antialiased">

        <div class="bg-gray-100">
            @include('layouts.navigation')
        </div>

        <div style="width: 65%; margin: 0 auto;">
            <h2>Lançamentos <b>Recentes</b></h2>
            <div id="div_products" class="item active">
                <div class="row row_cards">
                    <div class="cards">
                        <div class="thumb-wrapper">
                            <div class="img-box">
                                <img src="img/ipad.jpg" class="img-responsive" alt="">
                            </div>
                            <div class="thumb-content">
                                <h4>Apple iPad</h4>
                                <p class="item-price"><strike>$400.00</strike> <span>$369.00</span></p>
                                <a href="#" class="btn btn-primary">Ver Detalhes</a>
                            </div>
                        </div>
                    </div>
                    <div class="cards">
                        <div class="thumb-wrapper">
                            <div class="img-box">
                                <img src="img/headphone.jpg" class="img-responsive" alt="">
                            </div>
                            <div class="thumb-content">
                                <h4>Sony Headphone</h4>
                                <p class="item-price"><strike>$25.00</strike> <span>$23.99</span></p>
                                <a href="#" class="btn btn-primary">Ver Detalhes</a>
                            </div>
                        </div>
                    </div>
                    <div class="cards">
                        <div class="thumb-wrapper">
                            <div class="img-box">
                                <img src="img/macbook-air.jpg" class="img-responsive" alt="">
                            </div>
                            <div class="thumb-content">
                                <h4>Macbook Air</h4>
                                <p class="item-price"><strike>$899.00</strike> <span>$649.00</span></p>
                                <a href="#" class="btn btn-primary">Ver Detalhes</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>