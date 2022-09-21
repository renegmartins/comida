<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CriaTabelaExpediente extends Migration{
    public function up(){
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,            
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'dia' => [
                'type' => 'INT',
                'constraint' => 5,
            ],
            'dia_descricao' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'abertura' => [
                'type' => 'TIME',
                'null' => true,
                'default' => null,
            ],
            'fechamento' => [
                'type' => 'TIME',
                'null' => false,
            ], 
            'situacao' => [
                'type' => 'BOOLEAN',
                'null' => false,
                'default' => true,
            ],           
        ]);


        $this->forge->addPrimaryKey('id')->addUniqueKey('id');

        $this->forge->createTable('expediente');
    }

    public function down(){
        $this->forge->dropTable('expediente');
    }
}
