<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KomikModel extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'judul' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'penulis' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'genre' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'sinopsis' => [
                'type' => 'TEXT',
                'constraint' => 255,
            ],
            'sampul' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('komik');
    }

    public function down()
    {
        $this->forge->dropTable('komik');
    }
}
