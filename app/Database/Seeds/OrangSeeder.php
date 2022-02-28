<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;

use CodeIgniter\Database\Seeder;

class OrangSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i < 100; $i++) {
            $data = [
                'nama' => $faker->name(),
                'alamat'    => $faker->address(),
                'created_at' => Time::now('Asia/Jakarta'),
                'updated_at' => Time::now('Asia/Jakarta')
            ];
            $this->db->table('orang')->insert($data);
        }



        // $data = [
        //     [
        //         'nama' => 'Abdul',
        //         'alamat'    => 'Bogor',
        //         'created_at' => Time::now('Asia/Jakarta'),
        //         'updated_at' => Time::now('Asia/Jakarta')
        //     ],
        //     [
        //         'nama' => 'Talif',
        //         'alamat'    => 'Ciomas',
        //         'created_at' => Time::now('Asia/Jakarta'),
        //         'updated_at' => Time::now('Asia/Jakarta')
        //     ],
        //     [
        //         'nama' => 'Parinduri',
        //         'alamat'    => 'Pagelaran',
        //         'created_at' => Time::now('Asia/Jakarta'),
        //         'updated_at' => Time::now('Asia/Jakarta')
        //     ]
        // ];

        // Simple Queries
        // $this->db->query("INSERT INTO users (username, email) VALUES(:username:, :email:)", $data);

        // Using Query Builder
        // $this->db->table('orang')->insert($data);
        // Using Query Builder untuk data lebih dari satu
        // $this->db->table('orang')->insertBatch($data);
    }
}
