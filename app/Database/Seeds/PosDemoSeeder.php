<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PosDemoSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        if ($this->db->table('customers')->countAllResults() === 0) {
            $this->db->table('customers')->insertBatch([
                ['full_name' => 'Jon Snow', 'email' => 'jon.snow@example.test', 'phone' => '09170000001', 'created_at' => $now],
                ['full_name' => 'Robb Stark', 'email' => 'robb.stark@example.test', 'phone' => '09170000002', 'created_at' => $now],
                ['full_name' => 'Ned Stark', 'email' => 'ned.stark@example.test', 'phone' => '09170000003', 'created_at' => $now],
                ['full_name' => 'Sansa Stark', 'email' => 'sansa.stark@example.test', 'phone' => '09170000004', 'created_at' => $now],
                ['full_name' => 'Arya Stark', 'email' => 'arya.stark@example.test', 'phone' => '09170000005', 'created_at' => $now],
            ]);
        }

        if ($this->db->table('users')->countAllResults() === 0) {
            $this->db->table('users')->insertBatch([
                ['username' => 'jon.snow', 'full_name' => 'Jon Snow', 'avatar' => null, 'created_at' => $now],
                ['username' => 'robb.stark', 'full_name' => 'Robb Stark', 'avatar' => null, 'created_at' => $now],
                ['username' => 'ned.stark', 'full_name' => 'Ned Stark', 'avatar' => null, 'created_at' => $now],
                ['username' => 'sansa.stark', 'full_name' => 'Sansa Stark', 'avatar' => null, 'created_at' => $now],
                ['username' => 'arya.stark', 'full_name' => 'Arya Stark', 'avatar' => null, 'created_at' => $now],
            ]);
        }
    }
}
