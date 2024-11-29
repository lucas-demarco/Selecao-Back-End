<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/estilo_base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<style>
    table {
        margin-top: 5%;
        text-align: center;

    }

    #td_btn {
        display: flex;
        justify-content: space-between;
    }
</style>

<body>
    <div class="bg-gray-100">
        @include('layouts.navigation')
    </div>

    <table id="tb_usuarios" class="table table-dark table-bordered table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Data Criação</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            @foreach($usuarios as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->dt_exclusao > 0 ? Auth::id() : Auth::id() }}</td>
                    <td>
                        <a href="{{ route('users.edit', ['id'=>$user->id]) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-user-edit"></i>
                        </a>
                        @if ($user->dt_exclusao > 0)
                            <a href="{{ route('users.ativar_inativar', ['id'=>$user->id]) }}">
                                <button type="button" class="btn btn-success btn-sm" onclick="$('#id_usuario').val({{ $user->id }});" title="Ativar Usuário">
                                    <i class="fas fa-user-check"></i>
                                </button>
                            </a>
                        @elseif ($user->id != Auth::id())
                            <button type="button" class="btn btn-danger btn-sm" onclick="$('#id_usuario').val({{ $user->id }});" title="Inativar Usuário" data-bs-toggle="modal" data-bs-target="#modal_delete">
                                <i class="fas fa-user-times"></i>
                            </button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>

    <input type="hidden" id="id_usuario">

    <div class="modal fade" id="modal_delete" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Inativar/Deletar Usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span>Você deseja apenas <b>inativar</b> o usuário ou <b>deletá-lo</b> permanentemente?</span>
                    <br> <br>
                    <span style="font-size: 14px;">
                        Lembre-se: Inativar será uma <b>exclusão lógica</b>, ou seja, irá apenas atribuir uma
                        <b>data de inativação</b> ao usuário, porém, deletá-lo irá <b>permanentente excluir</b> o registro do banco de dados!
                    </span>
                </div>
                <div class="modal-footer" style="justify-content: center;">
                    <button type="button" class="btn btn-warning" id="inativar-btn">Inativar</button>
                    <button type="button" class="btn btn-danger" id="delete-btn">Deletar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        $('#inativar-btn').click(function() {
            let url = "{{ route('users.ativar_inativar', ['id' => '__ID__']) }}".replace('__ID__', $('#id_usuario').val());
            window.location.href = url; // Redireciona o usuário para a URL gerada
        });
        $('#delete-btn').click(function() {
            let url = "{{ route('users.destroy', ['id' => '__ID__']) }}".replace('__ID__', $('#id_usuario').val());
            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                    _token: $('[name="_token"]').val(),
                }, success: function(result) {
                    location.reload();
                }, error: function(xhr, status, error) {
                    alert('Erro ao deletar usuário: ' + error);
                }
            });
        });
    </script>
</body>

</html>