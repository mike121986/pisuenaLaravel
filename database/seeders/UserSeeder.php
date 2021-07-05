<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=> 'Miguel gernandez',
            'email' => 'correo@correo.com',
            'password' => bcrypt('1234567890')
        ]);
    }
}
