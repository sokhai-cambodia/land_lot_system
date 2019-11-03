<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create([
            'name' => 'admin',
            'description' => 'admin role',
            'created_by' => 1
        ]);

        DB::table('users')->insert([
            'last_name' => 'admin',
            'first_name' => 'admin',
            'dob' => '1996-01-01',
            'gender' => 'male',
            'username' => 'admin',
            'password' => Hash::make('admin@123'),
            'role_id' => $role->id,
            'created_by' => 1
        ]);
    }
}
