<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'name' => 'Administrator',
        	'email' => 'roksta21@gmail.com',
        	'password' => bcrypt('roksta')
        ]);
    }
}
