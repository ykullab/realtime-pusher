<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            User::updateOrCreate(["email"=>"yaser@gmail.com"] ,["name"=>"yaser" ,"email"=>"yaser@gmail.com","password"=>bcrypt("1234567")]);
    }
}
