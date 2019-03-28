<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\User;



class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = "Admin";
        $user->email = "admin@localhost.com";
        $user->username = "admin";
        $user->password = Hash::make("adminpass");
        $user->save();

        $user1 = new User;
        $user1->name = "User One";
        $user1->email = "user@localhost.com";
        $user1->username = "userone";
        $user1->password = Hash::make("adminpass");
        $user1->save();
    }
}
