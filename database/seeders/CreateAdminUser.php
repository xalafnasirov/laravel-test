<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            "name"=> "admin",
            "email"=> "admin@gmail.com",
            "password"=> Hash::make("12345678"),
        ]);
    }
}
