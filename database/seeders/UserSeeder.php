<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Admin DMS ATK',
                'email' => 'admin@dms-atk.local',
                'password' => Hash::make('AdminDMS123!'),
                'role' => 'admin',
                'is_active' => true,
            ]
        );

        User::updateOrCreate(
            ['username' => 'pemilik'],
            [
                'name' => 'Pemilik Toko',
                'email' => 'pemilik@dms-atk.local',
                'password' => Hash::make('PemilikDMS123!'),
                'role' => 'pemilik',
                'is_active' => true,
            ]
        );
    }
}