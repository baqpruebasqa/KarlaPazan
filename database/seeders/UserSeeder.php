<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@hotmail.com',
                'password' => '123',
                'role' => 'Administrador',
            ],
            [
                'name' => 'John',
                'email' => 'john@hotmail.com',
                'password' => '123456',
                'role' => 'Coordinador',
            ],
            [
                'name' => 'Pamela',
                'email' => 'pamela@hotmail.com',
                'password' => '123456',
                'role' => 'Visualizador',
            ]
        ];

        foreach($users as $user) {
            $created_user = User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
            ]);

            $created_user->assignRole($user['role']);
        }
    }
}
