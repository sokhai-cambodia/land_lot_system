<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Company;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $role = Role::create([
        //     'name' => 'admin',
        //     'description' => 'admin role',
        //     'created_by' => 1
        // ]);
        $company = Company::create([
            'name' => 'MISTEAM',
            'slug' => 'misteam',
            'address' => 'Phnom Penh',
            'found_at' => date('Y-m-d'),
            'status' => 'active',
            'created_by' => 1,
        ]);

        User::create([
            'company_id' => $company->id,
            'last_name' => 'admin',
            'first_name' => 'admin',
            'dob' => '1996-01-01',
            'gender' => 'male',
            'username' => 'admin',
            'password' => Hash::make('admin@123'),
            'status' => 'active',
            'role' => 'owner',
            'created_by' => 1
        ]);
    }
}
