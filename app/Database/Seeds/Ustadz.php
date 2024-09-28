<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Ustadz extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            $faker = \Faker\Factory::create();
            $data = [
                'username' => $faker->userName,
                'password' => $faker->password,
                'fullname' => $faker->name,
                'gender'   => $faker->randomElement(['Pria', 'Wanita']),
                'email'    => $faker->email,
                'phone'    => $faker->phoneNumber(),
            ];
            $this->db->table('ustadz')->insert($data);
        }
    }
}
