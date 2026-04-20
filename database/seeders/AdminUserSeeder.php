<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder; // 👈 INI YANG KURANG
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'adminku@mail.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );
    }
}
