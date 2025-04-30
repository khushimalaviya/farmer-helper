<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Users
        $admin = User::create([
            'username' => 'Hensi Padasala',
            'email' => 'hensipadasala158@gmail.com',
            'password' => bcrypt('password'),
            'contact_no' => '9269563589'
        ]);

        $user = User::create([
            'username' => 'Khushi Malaviya',
            'email' => 'malaviyakhushi60@gmail.com',
            'password' => bcrypt('password'),
            'contact_no' => '8160359368'
        ]);

        // Assign Roles
        $adminRole = Role::where('u_role', 'Admin')->first();
        $userRole = Role::where('u_role', 'User')->first();

        $admin->roles()->attach($adminRole);
        $user->roles()->attach($userRole);
    }
}
