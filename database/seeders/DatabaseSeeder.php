<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        
        $user = new User;
        $user->name = 'Admin';
        $user->email ='admin@gmail.com';
        $user->role = 'admin';
        $user->password = bcrypt('123');
        $user->save();

        $user = new User;
        $user->name = 'Customer';
        $user->email ='customer@gmail.com';
        $user->role = 'customer';
        $user->password = bcrypt('123');
        $user->save();
    }
}
