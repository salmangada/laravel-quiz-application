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
        //
        $user=[
            'name'=>'student',
            'email'=>'student@gmail.com',
            'password'=>bcrypt('password'),
        ];

        User::create($user);
    }
}
