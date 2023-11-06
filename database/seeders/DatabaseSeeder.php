<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

         // $this->call(UsersTableSeeder::class);
         DB::table('users')->insert([
            'username' => "Alice",
            'role'=>"student",
            'user_session'=>0,
        ]);

        DB::table('users')->insert([
            'username' => "Bob",
            'role'=>"student",
            'user_session'=>0,
        ]);

        DB::table('users')->insert([
            'username' => "Professor",
            'role'=>"lecturer",
            'user_session'=>0,
        ]);
    }
}
