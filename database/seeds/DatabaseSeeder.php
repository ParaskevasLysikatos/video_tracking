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
