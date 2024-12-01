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
                'descricao' => 'O iPad 10 é o blend perfeito entre smartphone e notebook. Do primeiro, a praticidade e facilidade de uso. Do segundo, a potência e a tela realmente imersiva, o tablet mais novo e de melhor custo-benefício da Apple.',
                'preco' => 3399.00,
                'desconto' => 299.00,
                'imagem' => 'ipad'
            ],
            [
                'nome' => 'Sony Headset',
                'descricao' => 'O fone de ouvido WH-1000XM4 traz o novo processador HDQN1 foi reconfigurado e ficou muito mais rápido, conseguindo analisar até 700x por segundo a informação que recebe, e assim cancelar o ruído de maneira muito mais rápida e efeicaz.',
                'preco' => 1859.00,
                'desconto' => 159.00,
                'imagem' => 'headset'
            ],
            [
                'nome' => 'Macbook Air',
                'descricao' => 'O chip M1 impulsiona o desempenho do notebook mais fino e leve da Apple. A CPU de oito núcleos ultrarrápida encara qualquer projeto. Com a GPU de até oito núcleos, os gráficos passam de nível em games e apps.',
                'preco' => 5799.99,
                'desconto' => 199.99,
                'imagem' => 'macbook-air'
            ]
        ]);
    }
}
