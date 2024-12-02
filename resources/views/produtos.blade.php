<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/estilo_base.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}">
</head>

<body class="antialiased">

    <div class="bg-gray-100">
        @include('layouts.navigation')
    </div>

    <div style="width: 65%; margin: 0 auto;">
        <h2>Lançamentos <b>Recentes</b></h2>
        <div id="div_products" class="item active">
            <div class="row row_cards">
                @foreach($produtos as $produto)
                    <div class="cards">
                        <div class="thumb-wrapper">
                            <div class="img-box">
                                <img src="img/{{ $produto->imagem }}.jpg" class="img-responsive" alt="">
                            </div>
                            <div class="thumb-content">
                                <h4>{{ $produto->nome }}</h4>
                                <p class="item-price"><strike>R$ {{ number_format($produto->preco, 2, ',', '.') }}</strike> 
                                <span>R$ {{ number_format($produto->preco - $produto->desconto, 2, ',', '.') }}</span></p>
                                <a href="{{ route('produtos.visualizar', ['id'=>$produto->id]) }}" class="btn btn-primary">Ver Detalhes</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div id="DivMessage">
        @if (session('error'))
            <div class="flash-message error">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                <button class="close-btn" onclick="this.parentElement.style.display='none';">×</button>
            </div>
        @endif

        @if (session('success'))
            <div class="flash-message success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button class="close-btn" onclick="this.parentElement.style.display='none';">×</button>
            </div>
        @endif
    </div>

    <script src="{{ asset('js/app.js') }}" defer></script>
</body>

</html>