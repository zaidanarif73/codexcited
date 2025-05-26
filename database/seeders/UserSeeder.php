<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Enums\RoleEnum;
use App\Models\User; 

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userAdministrator = User::firstOrCreate([
            'email' => 'superadmin@gmail.com'
            ],[
            'name' => 'SuperAdmin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('superadmin'),
            'email_verified_at' => date('Y-m-d H:i:s'),
            ]);
        $userAdministrator->assignRole(RoleEnum::SuperAdmin);

        $userAdministrator = User::firstOrCreate([
            'email' => 'teacher@gmail.com'
            ],[
            'name' => 'teacher',
            'email' => 'teacher@gmail.com',
            'password' => bcrypt('teacher123'),
            'email_verified_at' => date('Y-m-d H:i:s'),
            ]);
        $userAdministrator->assignRole(RoleEnum::Teacher);

        $userAdministrator = User::firstOrCreate([
            'email' => 'student@gmail.com'
            ],[
            'name' => 'Student',
            'email' => 'student@gmail.com',
            'password' => bcrypt('student123'),
            'email_verified_at' => date('Y-m-d H:i:s'),
            ]);
        $userAdministrator->assignRole(RoleEnum::Student);

        $userAdministrator = User::firstOrCreate([
            'email' => 'student2w@gmail.com'
            ],[
            'name' => 'Student2',
            'email' => 'student2@gmail.com',
            'password' => bcrypt('student2'),
            'email_verified_at' => date('Y-m-d H:i:s'),
            ]);
        $userAdministrator->assignRole(RoleEnum::Student);
    }
}
