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
        $names = ['Ahmed','Admin','Ali'];



        for ($i = 0; $i < count($names); $i++) {
            \App\User::create([
                'name' => $names[$i],
                'email' => $names[$i]. '@app.com',
                'password' => bcrypt('admin')
            ]);
        }
    }
}
