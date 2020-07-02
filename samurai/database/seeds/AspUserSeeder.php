<?php

use Illuminate\Database\Seeder;

class AspUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('asp_users')->insert([
        	'first_name'=>'Admin',
        	'last_name'=>'asp',
        	'email'=>'admin_asp@samurai.website',
        	'account'=>'asp_admin',
        	'password'=>md5('asp@admin'),
        	'role'=>'admin'//admin,mod,member
        ]);
    }
}
