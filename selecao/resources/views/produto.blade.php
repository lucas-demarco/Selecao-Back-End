<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $produto->nome }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/estilo_base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/produto.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <script src="{{ asset('js/app.js') }}" defer></script>

</head>

<body class="antialiased">

    <input type="hidden" id="url_comentarios" value="{{ route('comentarios.listar', ['id'=>$produto->id]) }}">
    <input type="hidden" id="url_hist_comentarios" value="{{ route('comentarios.historico', ['id' => ':id']) }}">
    <input type="hidden" id="url_adicionar" value="{{ route('comentarios.adicionar', ['id'=>$produto->id]) }}">
    <input type="hidden" id="url_atualizar" value="{{ route('comentarios.update') }}">
    <input type="hidden" id="url_delete" value="{{ route('comentarios.delete') }}">
    @auth
        <input type="hidden" id="csrf_token" value="{{ csrf_token() }}">
    @endif
    <div class="bg-gray-100">
        @include('layouts.navigation')
    </div>
    <!-- Modal Comentarios -->
    <div id="modal_comentarios" class="modal">
        <div class="modal-content">
            <div id="div_close">
                <span class="close">&times;</span>
            </div>
            <div id="content_comentarios">
            </div>
        </div>
    </div>
    <div style="display: flex; align-items: center;">
        <div id="div_products" class="item active">
            <div id="sub_div_product" class="sub_div">
                <div style="width: 25%;">
                    <img src="{{ asset('img/' . $produto->imagem . '.jpg') }}" alt="">
                </div>
                <div id="informacoes">
                    <p id="nome">{{ $produto->nome }}</p>
                    <hr><br>
                    <p style="font-size: 12px;">Novo Original e com Garantia</p>
                    <p style="font-weight: bold;">Características:</p>
                    <br>
                    <p>{{ $produto->descricao }}</p>
                </div>
                <div id="valores">
                    <div>
                        <p style="font-size: 14px;"><strike>R$ {{ number_format($produto->preco, 2, ',', '.') }}</strike></p>
                        <p id="valor_final">R$ {{ number_format($valor, 2, ',', '.') }}</p>
                    </div>
                    <div>
                        <p style="font-size: 15px;">3x de R$ {{ number_format($valor / 3, 2, ',', '.') }}</p>
                        <p style=""><b>5% de desconto</b> pagando com Pix</p>
                    </div>
                    <div>
                        <button id="btn_comprar">Fora de estoque</button>
                    </div>
                </div>
            </div>
            <div id="sub_div_comments" class="sub_div">
                
            </div>
        </div>
        <div class="wrapper">
            <div class="title">Compartilhe sua experiência</div>
            <form id="form_comentario">
                @csrf
                @method('POST')
                <div class="rate-box">
                    <input type="radio" name="star" id="star5"/><label class="star" for="star5"></label>
                    <input type="radio" name="star" id="star4"/><label class="star" for="star4"></label>
                    <input type="radio" name="star" id="star3" checked="checked"/><label class="star" for="star3"></label>
                    <input type="radio" name="star" id="star2"/><label class="star" for="star2"></label>
                    <input type="radio" name="star" id="star1"/><label class="star" for="star1"></label>
                </div>
                <textarea name="comentario" id="comentario" class="bloquear" maxlength="700" cols="45" rows="6"></textarea>
                <button type="submit" class="submit-btn">Enviar</button>
            </form>
        </div>
    </div>

    <div style="display: none;">
        <form id="form_atualizar">
            @csrf
            @method('PUT')
            <input type="hidden" name="comentario_atz" id="comentario_atz">
            <input type="hidden" name="id_comentario_atz" id="id_comentario_atz">
        </form>
        <form id="form_delete">
            @csrf
            @method('DELETE')
            <input type="hidden" name="comentario_delete" id="comentario_delete">
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/produtos.js') }}" defer></script>
    <script>
        // Função responsável por exibir os comentários.
        function listar_comentarios(comentarios) {
            $.each(comentarios, function (index, coment) {

                let dt_postagem = btn_editar = btn_apagar = btn_historico = stars = '';
                for (let i = 0; i < coment.avaliacao; i++) {
                    stars += '&#9733; ';
                }

                @auth
                    if (coment.id_usuario == {{Auth::user()->id}}) {
                        btn_editar = `<button type="button" class="btn-editar" comentario="${coment.id}"><i class="far fa-edit"></i></button>`;
                    }
                    if (coment.id_usuario == {{Auth::user()->id}} || {{Auth::user()->userType}} == 1) {
                        btn_apagar = `<button type="button" class="btn-apagar" comentario="${coment.id}"><i class='fa fa-trash-alt'></i></button>`;
                    }
                @endif

                if (coment.editado) {
                    dt_postagem = 'Editado em ';
                    btn_historico = `<button type="button" class="btn-historico" comentario="${coment.id}"><i class="fas fa-history"></i></button>`;
                } else {
                    dt_postagem = 'Postado em ';
                }

                dt_postagem += `${coment.data_formatada} às ${coment.horario_formatado}`;

                let DOM = `<div style="margin-bottom: 1rem;">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <i class="fas fa-user-circle" style="font-size: 1.8rem;"></i>
                                <span>${coment.name}</span>
                                <div class="stars">
                                    ${stars} <!-- Exibe as estrelas conforme a avaliação -->
                                </div>
                                <div style="flex-grow: 1;"></div>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    ${btn_historico}
                                    ${btn_editar}
                                    ${btn_apagar}
                                    <span class="dt_postagem">
                                        ${dt_postagem}
                                    </span>
                                </div>
                            </div>
                            <div class="div_comentario">
                                <textarea id="comentario_${coment.id}" maxlength="700" class="editar_comentario" disabled>${coment.comentario}</textarea>
                            </div>
                        </div>`;

                $("#sub_div_comments").append(DOM);
            });
        }
    </script>
</body>

</html>