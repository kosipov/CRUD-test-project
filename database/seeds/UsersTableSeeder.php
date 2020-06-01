<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => str_random(10),
            'email' => 'admin@test.loc',
            'password' => bcrypt('password'),
        ]);
        factory(App\User::class, 15)->create();
    }
}
