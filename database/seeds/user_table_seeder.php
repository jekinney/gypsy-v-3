<?php

use App\User;
use Illuminate\Database\Seeder;

class user_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'username' => 'Jason',
        	'email'    => 'jekinneys@yahoo.com',
        	'password' => 'aubreys1',
        	'admin'    => 1,
        ]);
    }
}
