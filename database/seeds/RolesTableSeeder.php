<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = new Role;
        $adminRole->title = "Admin";
        $adminRole->description = "This is an admin position";
        $adminRole->save();

        $userRole = new Role;
        $userRole->title = "User";
        $userRole->description = "This is an user position";
        $userRole->save();
    }
}
