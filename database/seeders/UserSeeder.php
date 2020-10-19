<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'vasishak.d@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt(config('app.admin_password')),
            'role' => User::ROLE_ADMIN,
        ]);
    }
}
