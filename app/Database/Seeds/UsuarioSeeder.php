<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    public function run()
    {
        
        $usuarioModel = new \App\Models\UsuarioModel;

        $usuario = [
            'nome' => 'Renê Martins',
            'email' => 'admin@email.com',
            'cpf' => '643.238.370-62',
            'telefone' => '16-9999-9999',
        ];


        $usuarioModel->protect(false)->insert($usuario);


        $usuario = [
            'nome' => 'Ana Martins',
            'email' => 'ana@email.com',
            'cpf' => '105.271.240-10',
            'telefone' => '16-8888-9999',
        ];


        $usuarioModel->protect(false)->insert($usuario);

        dd($usuarioModel->errors());

    }
}
