<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CriaTabelaFormasPagamento extends Migration{
    public function up(){
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,            
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nome' => [
                'type' => 'VARCHAR',
                'constraint' => '128',
            ],
            'ativo' => [
                'type' => 'BOOLEAN',
                'null' => false,
                'default' => true,
            ],
            'criado_em' => [
                'type' => 'DATETIME',
                'null' => 'true',
                'dafault' => 'null',
            ],
            'atualizado_em' => [
                'type' => 'DATETIME',
                'null' => 'true',
                'dafault' => 'null',
            ],
            'deletado_em' => [
                'type' => 'DATETIME',
                'null' => 'true',
                'dafault' => 'null',
            ],
        ]);


        $this->forge->addPrimaryKey('id')->addUniqueKey('nome');

        $this->forge->createTable('formas_pagamento');
    }

    public function down()
    {
        $this->forge->dropTable('formas_pagamento');
    }
}
