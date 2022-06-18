<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Silab extends Migration
{
    public function up()
    {
        // create rooms table
        $fields = [
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'room_name' => ['type' => 'VARCHAR', 'constraint' => 255],
            'room_slug' => ['type' => 'VARCHAR', 'constraint' => 255],
            'room_description' => ['type' => 'TEXT'],
            'created_at' => ['type' => 'DATETIME'],
            'updated_at' => ['type' => 'DATETIME'],
        ];
        $this->forge->addPrimaryKey('id');
        $this->forge->addField($fields);
        $this->forge->createTable('rooms', true);

        // create tools table
        $fields = [
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'room_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'tool_name' => ['type' => 'VARCHAR', 'constraint' => 255],
            'tool_slug' => ['type' => 'VARCHAR', 'constraint' => 255],
            'tool_description' => ['type' => 'TEXT'],
            'tool_quantity' => ['type' => 'INT', 'constraint' => 11],
            'created_at' => ['type' => 'DATETIME'],
            'updated_at' => ['type' => 'DATETIME'],
        ];
        $this->forge->addField($fields);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('room_id', 'rooms', 'id');
        $this->forge->createTable('tools', true);

        // Create loans table
        $fields = [
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'room_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'start_time' => ['type' => 'DATETIME'],
            'end_time' => ['type' => 'DATETIME'],
            'status' => ['type' => 'INT', 'constraint' => 1],
            'created_at' => ['type' => 'DATETIME'],
            'updated_at' => ['type' => 'DATETIME'],
        ];
        $this->forge->addField($fields);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('room_id', 'rooms', 'id');
        $this->forge->createTable('loans', true);

        // Create loan tools table
        $fields = [
            'loan_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'tool_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
        ];
        $this->forge->addField($fields);
        $this->forge->addForeignKey('loan_id', 'loans', 'id');
        $this->forge->addForeignKey('tool_id', 'tools', 'id');
        $this->forge->createTable('loan_tools', true);
    }

    public function down()
    {
        // drop all tables
        $this->forge->dropTable('rooms', true);
        $this->forge->dropTable('tools', true);
        $this->forge->dropTable('loans', true);
    }
}
