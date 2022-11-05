<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class AnimeSeeder extends Seeder
{
    public function run()
    {
        // $data = [
        //     [
        //         'judul' => 'Naruto',
        //         'studio' => 'Mappa',
        //         'slug' => '',
        //         'created_at' => Time::now(),
        //         'updated_at' => Time::now()
        //     ],
        //     [
        //         'judul' => 'One Piece',
        //         'studio' => 'Koei',
        //         'slug' => '',
        //         'created_at' => Time::now(),
        //         'updated_at' => Time::now()
        //     ]
        // ];

        $faker = \Faker\Factory::create();
        for($i = 0; $i < 100; $i++){
            $slug = $faker->word;
            $judul = ucfirst($slug);
            $data = [
                'judul' => $judul,
                'studio' => $faker->company,
                'slug' => $slug,
                'created_at' => Time::createFromTimestamp($faker->unixTime()),
                'updated_at' => Time::now()
            ];
            
            $this->db->table('anime')->insert($data);
        }


        //Simple Query

        // $this->db->query(
        //     "INSERT INTO anime (judul, studio, created_at, updated_at) VALUES(:judul:, :studio:, :created_at:, :updated_at:)", $data
        // );

        //Query Builder

        // $this->db->table('anime')->insert($data); // untuk 1 data
        // $this->db->table('anime')->insertBatch($data); // untuk byk data

    }
}
