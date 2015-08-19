<?php

use Illuminate\Database\Seeder;
use App\User;


class UserTableSeeder extends Seeder {

    /**
     * Delete all rows and then seed the users table
     */
    public function run()
    {
        DB::table('users')->delete();

        User::create([
            'email' => 'foo@bar.com',
            'password' => Hash::make('test1234'),
        ]);
    }

}