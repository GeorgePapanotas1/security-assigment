<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AddAssignedUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = [
            "name" => "3312009",
            "email" => "gpapanotas@aueb.gr",
            "password"=> Hash::make('testing', [
                'rounds' => 15,
            ]),
            "description" => "The first user"
        ];

        $user2 = [
            "name" => "admin",
            "email" => "admin@aueb.gr",
            "password"=> Hash::make('MYlittlEM3RM@Aid', [
                'rounds' => 15,
            ]),
            "description" => "The second user"
        ];

        $user = User::firstOrCreate($user1);
        $user = User::firstOrCreate($user2);
    }
}
