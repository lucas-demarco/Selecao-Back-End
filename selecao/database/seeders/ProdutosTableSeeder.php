<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdutosTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('produtos')->insert([
            [
                'nome' => 'Apple iPad',
                'descricao' => 'temporario',
                'preco' => 3399.00,
                'desconto' => 299.00,
                'imagem' => 'ipad'
            ],
            [
                'nome' => 'Sony Headset',
                'descricao' => 'temporario',
                'preco' => 1859.00,
                'desconto' => 159.00,
                'imagem' => 'headset'
            ],
            [
                'nome' => 'Macbook Air',
                'descricao' => 'temporario',
                'preco' => 5799.99,
                'desconto' => 199.99,
                'imagem' => 'macbook-air'
            ]
        ]);
    }
}
