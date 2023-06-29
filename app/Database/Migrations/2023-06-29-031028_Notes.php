<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Notes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type'           => 'VARCHAR',
                'constraint'     => '80',
            ],
            'content' => [
                'type'           => 'TEXT',
            ],
            'date' => [
                'type'           => 'DATETIME',
                'default'        => 'current_timestamp()',
            ],
        ]);
        $this->forge->addKey('id', TRUE); // primary key
        $this->forge->createTable('notes', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('notes');
    }
}