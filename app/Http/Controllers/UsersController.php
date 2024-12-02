<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index()
    {
        if (Auth::check() && Auth::user()->userType == 1) {
            $users = User::all();
            return view('usuarios.listar', ['usuarios' => $users]);
        } else {
            session()->flash('error', 'Você não tem permissão para acessar esta página.');
            return redirect('/');  
        }
    }

    public function edit($id)
    {
        if (Auth::check() && (Auth::user()->userType == 1 || Auth::id() == $id)) {
            $user = User::where('id', $id)->first();
            if(!empty($user)) {
                return view('usuarios.editar', ['user' => $user]);
            } else {
                return redirect()->route('users.index');
            }
        } else {
            session()->flash('error', 'Você não tem permissão para acessar esta página.');
            return redirect('/'); 
        }
    }

    public function update(Request $request, $id)
    {
        if ($request->password == $request->password_confirmation) {
            $senha = Hash::make($request->password);
        } else {
            session()->flash('error', 'As senhas devem ser iguais!');
            return redirect('users.edit'); 
        }

        $data = [
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => $senha,
            'updated_at' => now()->format('Y-m-d H:i:s')
        ];

        User::where('id', $id)->update($data);
        session()->flash('success', 'Senha alterada com sucesso.');
        return redirect('/');
    }

    public function ativar_inativar($id)
    {
        $user = User::where('id', $id)->first();

        if ($user->dt_exclusao > 0) {
            $data = [
                'updated_at'  => now()->format('Y-m-d H:i:s'),
                'dt_exclusao' => NULL
            ];
        } else {
            $data = [
                'updated_at'  => now()->format('Y-m-d H:i:s'),
                'dt_exclusao' => now()->format('Y-m-d H:i:s')
            ];
        }

        User::where('id', $id)->update($data);
        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return response()->json(['success' => true]);
    }
}