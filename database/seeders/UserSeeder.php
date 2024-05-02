<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin Prame',
                'email' => 'prame@gmail.com',
                'role' => 'admin',
                'password' => bcrypt('password'),
            ],
            // [
            //     'name' => 'Teacher User',
            //     'firstname' => 'Ben',
            //     'lastname' => 'Ten',
            //     'email' => 'teacher@gmail.com',
            //     'role' => 'teacher',
            //     'password' => bcrypt('password'),
            // ],
            // [
            //     'name' => 'User',
            //     'firstname' => 'Ping',
            //     'lastname' => 'Ping',
            //     'email' => 'user@gmail.com',
            //     'role' => 'user',
            //     'password' => bcrypt('password'),
            // ],
        ]);
    }
}
