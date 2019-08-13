<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User([
            'name' => "SuperDuperAdmin",
            'email' => 'SuperDuper@mail.ru',
            'password' => Hash::make('SuperDuperPassword'),
        ]);
        $user->save();
        $user->assignRole("super-admin");
    }
}
