<?php


namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {

        $users = [

            [
               'name'=>'Admin User',
               'email'=>'admin@example.com',
               'type'=>1,
               'password'=> bcrypt('123456'),
            ],

            [
               'name'=>'Manager User',
               'email'=>'manager@example.com',
               'type'=> 2,
               'password'=> bcrypt('123456'),
            ],

            [
               'name'=>'User',
               'email'=>'user@example.com',
               'type'=>3,
               'password'=> bcrypt('123456'),

            ],

        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }

    }

}
