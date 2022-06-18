<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Silab extends Seeder
{
    public function run()
    {
        // Seeding auth groups
        $this->db->table('auth_groups')->insert([
            'name' => 'admin',
            'description' => 'Administrator',
        ]);
        $this->db->table('auth_groups')->insert([
            'name' => 'mahasiswa',
            'description' => 'Mahasiswa',
        ]);
        $this->db->table('auth_groups')->insert([
            'name' => 'dosen',
            'description' => 'Dosen',
        ]);
        $this->db->table('auth_groups')->insert([
            'name' => 'karyawan',
            'description' => 'Karyawan',
        ]);

        // Seeding rooms table
        $this->db->table('rooms')->insert([
            'room_name' => 'Lab. Mini Studio TV',
            'room_slug' => 'lab-mini-studio-tv',
            'room_description' => 'Laboratorium Mini Studio TV',
        ]);
        $this->db->table('rooms')->insert([
            'room_name' => 'Lab. PR',
            'room_slug' => 'lab-pr',
            'room_description' => 'Laboratorium Public Relations',
        ]);
        $this->db->table('rooms')->insert([
            'room_name' => 'Lab. Design Grafis',
            'room_slug' => 'lab-design-grafis',
            'room_description' => 'Laboratorium Design Grafis',
        ]);

        // Seeding tools table
        $this->db->table('tools')->insert([
            'room_id' => 1,
            'tool_name' => 'Komputer',
            'tool_slug' => 'komputer',
            'tool_description' => 'Komputer',
        ]);
        $this->db->table('tools')->insert([
            'room_id' => 1,
            'tool_name' => 'Laptop',
            'tool_slug' => 'laptop',
            'tool_description' => 'Laptop',
        ]);
        $this->db->table('tools')->insert([
            'room_id' => 1,
            'tool_name' => 'Monitor',
            'tool_slug' => 'monitor',
            'tool_description' => 'Monitor',
        ]);
        $this->db->table('tools')->insert([
            'room_id' => 1,
            'tool_name' => 'Kamera',
            'tool_slug' => 'kamera',
            'tool_description' => 'Kamera',
        ]);
        $this->db->table('tools')->insert([
            'room_id' => 1,
            'tool_name' => 'Speaker',
            'tool_slug' => 'speaker',
            'tool_description' => 'Speaker',
        ]);
    }
}
