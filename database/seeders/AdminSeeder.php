<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'id' => (string) Str::uuid(),
            'name' => 'Admin',
            'username' => 'admin',
            'phone' => '08123456789',
            'email' => 'admin@mail.com',
            'password' => Hash::make('000000'),
        ]);
    }
}
