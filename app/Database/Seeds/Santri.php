<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Santri extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 100; $i++) {
            $faker = \Faker\Factory::create();
            $data = [
                'nis'      => $faker->randomNumber(6, true),
                'password' => $faker->password,
                'fullname' => $faker->name,
                'gender'   => $faker->randomElement(['Pria', 'Wanita']),
                'email'    => $faker->email,
                'phone'    => $faker->phoneNumber(),
            ];
            $this->db->table('santri')->insert($data);
        }
    }
}
