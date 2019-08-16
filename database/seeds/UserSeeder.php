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

        $user = new \App\User([
            'name' => "dude",
            'email' => 'dude@mail.com',
            'password' => Hash::make('dudes_password'),
        ]);
        $user->save();
        $user->assignRole("user");

        $user = new \App\User([
            'name' => "dude2",
            'email' => 'dude2@mail.com',
            'password' => Hash::make('dudes_password'),
        ]);
        $user->save();
        $user->assignRole("user");
    }
}
