<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SuperAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Find super admin role
         $superAdminRole = Role::where('name', 'Super Admin')->first();

         // Create super admin user and assign role
         $superAdminUser = User::firstOrCreate([
             'name' => 'Super Admin User',
             'email' => 'superadmin@example.com',
             'user_type' => 'superadmin',
             'password' => Hash::make('password'),
         ]);
         $superAdminUser->assignRole($superAdminRole);
    }
}
