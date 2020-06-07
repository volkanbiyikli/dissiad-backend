<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(

            [
                [
                    'name' => 'Volkan Bıyıklı',
                    'email' => 'volkan@100derece.com',
                    'email_verified_at' => null,
                    'password' => Hash::make('12345678'),
                    'image' => null,
                    'status' => '1',
                    'role' => '1'
                ]
            ]
        );
    }
}
