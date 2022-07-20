<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            "name" => 'Admin',
            "email" => 'admin@parking.com',
            "password" => bcrypt('adminParking'),
        ]);
        $admin->assignRole('admin');

        $employee = User::create([
            "name" => "Petugas",
            "email" => 'petugas@parking.com',
            "password" => bcrypt('petugasParking'),
        ]);
        $employee->assignRole('petugas');
    }
}
