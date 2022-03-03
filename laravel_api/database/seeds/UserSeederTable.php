<?php

use Illuminate\Database\Seeder;

class UserSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Roberto',
            'email' => 'beto@gmail.com',
            'password' => Hash::make('admin'),
        ]);
    }
}
