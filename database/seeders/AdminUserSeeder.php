<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin role if it doesn't exist
        $adminRole = DB::table('roles')->where('name', 'admin')->first();

        if (!$adminRole) {
            $adminRoleId = DB::table('roles')->insertGetId([
                'name' => 'admin',
                'description' => 'Administrator role',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $adminRoleId = $adminRole->id;
        }

        // Create admin user if it doesn't exist
        $adminUser = DB::table('users')->where('email', 'admin@clms.com')->first();

        if (!$adminUser) {
            DB::table('users')->insert([
                'name' => 'Administrator',
                'email' => 'admin@clms.com',
                'password' => Hash::make('admin123'),
                'role_id' => $adminRoleId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $this->command->info('Admin user created: admin@clms.com / admin123');
        } else {
            $this->command->info('Admin user already exists');
        }
    }
}
