<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (User::count() > 0) {
            return;
        }

        //create a admin user who can add product data with admin role
        $user = new User();
        $user->name = 'Admin';
        $user->email = 'admin@test.mail';
        $user->password = Hash::make('1234567890');
        $user->role = RoleEnum::ADMIN->value;
        $user->save();

        User::factory()
            ->state([
                'email' => 'user1@test.mail'
            ])
            ->create();

        User::factory()->count(3)->create();
    }
}
