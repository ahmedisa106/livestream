<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i <= 2; $i++) {
            \App\User::create([
                'name' => 'user' . $i,
                'email' => 'user' . $i . '@app.com',
                'password' => bcrypt('admin')
            ]);
        }
    }
}
