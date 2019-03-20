<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
            'username' => "Alice",
            'user_session'=>0,
        ]);

        DB::table('users')->insert([
            'username' => "Bob",
            'user_session'=>0,
        ]);

        DB::table('users')->insert([
            'username' => "Nick",
            'user_session'=>0,
        ]);

        DB::table('users')->insert([
            'username' => "Jacob",
            'user_session'=>0,
        ]);

        DB::table('users')->insert([
            'username' => "Macy",
            'user_session'=>0,
        ]);

        DB::table('users')->insert([
            'username' => "Roberta",
            'user_session'=>0,
        ]);

        DB::table('users')->insert([
            'username' => "Paris",
            'user_session'=>0,
        ]);

    }
}
