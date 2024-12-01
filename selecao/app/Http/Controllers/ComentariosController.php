<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ComentariosController extends Controller
{
    public function listar($id)
    {
        $comentarios = DB::table('comentarios')
                        ->leftJoin('users', 'comentarios.id_usuario', '=', 'users.id')
                        ->where('comentarios.id_produto', $id)
                        ->select('comentarios.*',
                            'users.name',
                            DB::raw("DATE_FORMAT(comentarios.created_at, '%d/%m/%Y') as data_formatada"),
                            DB::raw("DATE_FORMAT(comentarios.created_at, '%H:%i:%s') as horario_formatado"),
                            DB::raw("
                                CASE 
                                    WHEN EXISTS (
                                        SELECT 1 
                                        FROM comentarios_historico 
                                        WHERE comentarios_historico.id_comentario = comentarios.id
                                    ) THEN 1
                                    ELSE 0
                                END AS editado
                            ")
                        )
                        ->get();

        if (!empty($comentarios)) {
            return response()->json(['comentarios' => $comentarios], 201);
        } else {
            return response()->json(['message' => 'Nenhum comentario encontrado.'], 500);
        }
    }

    public function historico(Request $request) 
    {
        $historico = DB::table('comentarios_historico as ch')
                        ->leftJoin('users', 'ch.id_usuario', '=', 'users.id')
                        ->where('ch.id_comentario', $request->id)
                        ->select('ch.comentario',
                            'users.name',
                            DB::raw("DATE_FORMAT(ch.created_at, '%d/%m/%Y %H:%i:%s') AS dt_criacao"),
                            DB::raw("DATE_FORMAT(ch.updated_at, '%d/%m/%Y %H:%i:%s') AS dt_atualizado")
                        )
                        ->get();

        if (!empty($historico)) {
            return response()->json(['historico' => $historico], 201);
        } else {
            return response()->json(['message' => 'Nenhum comentario encontrado.'], 500);
        }
    }

    public function adicionar(Request $request, $id)
    {
        $comentario = Comentario::create([
            'id_usuario' => Auth::id(),
            'id_produto' => $id,
            'comentario' => $request->comentario,
            'avaliacao'  => $request->avaliacao
        ]);

        if ($comentario) {
            return response()->json(['message' => 'Comentário enviado com sucesso!'], 201);
        } else {
            return response()->json(['message' => 'Erro ao enviar o comentário.'], 500);
        }
    }

    public function update(Request $request)
    {
        $comentario = Comentario::find($request->id_comentario_atz);

        // Adicionar o estado atual do comentário ao histórico
        $historico = DB::table('comentarios_historico')->insert([
            'id_comentario' => $comentario->id,
            'id_usuario'    => $comentario->id_usuario,
            'id_produto'    => $comentario->id_produto,
            'comentario'    => $comentario->comentario,
            'avaliacao'     => $comentario->avaliacao,
            'created_at'    => $comentario->updated_at,
            'updated_at'    => now()->format('Y-m-d H:i:s'),
        ]);

        if (!$historico) {
            return response()->json(['message' => 'Erro ao salvar o histórico do comentário.'], 500);
        }

        $atz = $comentario->update([
            'comentario' => $request->comentario_atz,
            'updated_at' => now()->format('Y-m-d H:i:s'),
        ]);
        
        if ($atz) {
            return response()->json(['message' => 'Comentário editado com sucesso!'], 201);
        } else {
            return response()->json(['message' => 'Erro ao atualizar o comentário.'], 500);
        }
    }

    public function destroy(Request $request)
    {
        Comentario::where('id', $request->comentario_delete)->delete();
        return response()->json(['message' => 'Comentário deletado com sucesso!'], 201);
    }
}
