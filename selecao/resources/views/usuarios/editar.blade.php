<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/estilo_base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>
    <div class="bg-gray-100">
        @include('layouts.navigation')
    </div>

    <div class="font-sans text-gray-900 antialiased" style="height: 100%; display: flex; justify-content: center; flex-direction: column;">
        <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 ">
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg box_campos">

                <form method="POST" action="{{ route('users.update', ['id'=>$user->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Nome -->
                    <div>
                        <label class="block font-medium text-sm text-white" for="name">Nome</label>
                        <input class="rounded-md w-full" id="name" type="text" name="name" value="{{ $user->name }}" required>
                    </div>

                    <!-- Email -->
                    <div class="mt-4">
                        <label class="block font-medium text-sm text-white" for="email">Email</label>
                        <input class="rounded-md w-full" id="email" type="email" name="email" value="{{ $user->email }}" required>
                    </div>

                    <!-- Senha -->
                    <div class="mt-4">
                        <label class="block font-medium text-sm text-white" for="password">Senha</label>
                        <input class="rounded-md w-full" id="password" type="password" name="password" required>
                    </div>

                    <!-- Confirmar Senha -->
                    <div class="mt-4">
                        <label class="block font-medium text-sm text-white" for="password_confirmation">Confirme a Senha</label>
                        <input class="rounded-md w-full" id="password_confirmation" type="password" name="password_confirmation" required>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-4">
                            Atualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>