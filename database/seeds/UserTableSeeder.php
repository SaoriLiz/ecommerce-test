<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name', 'admin')->first()->id;
        $role_user = Role::where('name', 'user')->first()->id;

        $user = new User();
        $user->name = 'Administrator';
        $user->username = 'admin';
        $user->email = 'admin@example.com';
        $user->password = 'Secret123';
        $user->role_id = $role_admin;
        $user->save();

        $user = new User();
        $user->name = 'User';
        $user->username = 'user';
        $user->email = 'user@example.com';
        $user->password = 'Secret123';
        $user->role_id = $role_user;
        $user->save();
    }
}
