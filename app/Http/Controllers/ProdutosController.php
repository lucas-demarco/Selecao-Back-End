<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    public function index()
    {
        $produtos = Produto::all();
        return view('produtos', ['produtos' => $produtos]);
    }

    public function visualizar($id)
    {
        $produto = Produto::where('id', $id)->first();
        $valor = $produto->preco - $produto->desconto;
        return view('produto', ['produto' => $produto, 'valor' => $valor]);
    }
}
