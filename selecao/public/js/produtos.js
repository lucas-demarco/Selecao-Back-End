$(document).ready(function () {

    // Bloquear envio de comentários se o usuario não estiver logado
    if (!$("#csrf_token").length) {
        $("#form_comentario").each(function () {
            $(this).prop('disabled', true);
            $(this).css('pointer-events', 'none');
        });
        $(".wrapper").click(function () {
            alert('Você deve estar logado para enviar comentarios!');
        });
    }

    // Requisição responsável por listar os comentarios.
    $.ajax({
        url: $("#url_comentarios").val(),
        method: 'GET',
        success: function (r) {
            if ((r.comentarios).length){
                listar_comentarios(r.comentarios);
            } else {
                let message = "<span style='text-align: center; color: #dd5a5a;'>Não há comentarios para este produto!</span>";
                $("#sub_div_comments").html(message);
            }
        },
        error: function (xhr, status, error) {
            alert(r.message);
        }
    });

    // Requisição para adicionar um comentario ao produto.
    $("#form_comentario").submit(function (event) {
        event.preventDefault();

        if ($("#comentario").val() != '') {
            let avaliacao = $("input[name='star']:checked").attr('id').replace('star', '');
            let formData = $(this).serialize() + '&avaliacao=' + avaliacao;

            $.ajax({
                url: $("#url_adicionar").val(),
                method: 'POST',
                data: formData,
                success: function (r) {
                    alert(r.message);
                    window.location.reload();
                },
                error: function (r, status, error) {
                    alert('Ocorreu um erro ao tentar adicionar o comentario, por favor, tente novamente.');
                    window.location.reload();
                }
            });
        } else {
            alert('Não é possível enviar um comentário vazio.');
        }
    });

    // Habilita a alteração do comentário
    $(document).on('click', '.btn-editar', function () {
        let id = $(this).attr('comentario');
        $("#comentario_" + id).prop('disabled', false);
        $("#comentario_" + id).focus();

        if (!$("#btn_editar_" + id).length) {
            let btn = `
                    <button type="button" id="btn_editar_${id}" onclick="atualizar_comentario(${id})">
                        <i class="fas fa-check-circle" style="font-size: 27px; color: green;"></i>
                    </button>`;
            $("#comentario_" + id).closest(".div_comentario").append(btn);
        }
    });

    // Requisição para deletar um comentario.
    $(document).on('click', '.btn-apagar', function () {
        if (confirm("Você tem certeza que deseja apagar permanentemente este comentário?")) {
            $("#comentario_delete").val($(this).attr('comentario'))
            $.ajax({
                url: $("#url_delete").val(),
                method: 'DELETE',
                data: $("#form_delete").serialize(),
                success: function (r) {
                    alert(r.message);
                    window.location.reload();
                },
                error: function (r, status, error) {
                    alert("Ocorreu um erro ao tentar deletar o comentario, por favor, tente novamente.");
                    window.location.reload();
                }
            });
        }
    });

    // Requisição para listar o histórico de comentarios.
    $(document).on('click', '.btn-historico', function () {
        let modal = $("#modal_comentarios");
        let id = $(this).attr('comentario');
        let url = $("#url_hist_comentarios").val().replace(':id', id);
        
        $.ajax({
            url: url,
            method: 'GET',
            success: function (r) {
                modal.css('display', 'block');
                listar_historico(r.historico);
            },
            error: function (xhr, status, error) {
                alert(r.message);
            }
        });
    });

    function listar_historico(comentarios) {

        $("#content_comentarios").html('');
        $.each(comentarios, function (index, coment) {
            let  = '';
            let dt_postagem = `Postado em ${(coment.dt_criacao).replace(" ", " às ")}`;

            let DOM = `<div style="margin-bottom: 1rem;">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <i class="fas fa-user-circle"></i>
                            <span>${coment.name}</span>
                            <div style="flex-grow: 1;"></div>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <span class="dt_postagem">
                                    ${dt_postagem}
                                </span>
                            </div>
                        </div>
                        <div class="div_comentario">
                            <span style="padding: 0.5rem 0.75rem;">${coment.comentario}</span>
                        </div>
                    </div>`;

            $("#content_comentarios").append(DOM);
        });
    }

    /* Ações para a modal */
    $(document).on('click', '.close', function () {
        modal.css('display', 'none');
    });

    $(window).on("click", function (event) {
        if ($(event.target).is(modal[0])) {
            modal.css('display', 'none');
        }
    });
    setTimeout(function() {
        $(".editar_comentario").each(function () {
            $(this).css('height', $(this).prop('scrollHeight') + 'px');
        });
    }, 300);
});

// Função para atualizar um comentario.
function atualizar_comentario(id) {

    $("#comentario_atz").val($("#comentario_" + id).val());
    $("#id_comentario_atz").val(id);
    $.ajax({
        url: $("#url_atualizar").val(),
        method: 'PUT',
        data: $("#form_atualizar").serialize(),
        success: function (r) {
            alert(r.message);
            window.location.reload();
        },
        error: function (r, status, error) {
            alert("Ocorreu um erro ao tentar atualizar o comentario, por favor, tente novamente.");
            window.location.reload();
        }
    });
}
