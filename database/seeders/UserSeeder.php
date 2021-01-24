<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
            'name' => 'Admin',
            'email' => 'admin@demo.com',
            'password' => Hash::make('admindemo123'),
            'role_id' => 1,
            'activation' => 1
        ]);

        User::create([
            'name' => 'Bibliotekat test',
            'email' => 'biblotekar@demo.com',
            'password' => Hash::make('bibliotekardemo123'),
            'role_id' => 2,
            'activation' => 1
        ]);

        User::create([
            'name' => 'Korisnik test',
            'email' => 'korisnik@demo.com',
            'password' => Hash::make('korisnikdemo123'),
            'role_id' => 3,
            'activation' => 1
        ]);
    }
}
