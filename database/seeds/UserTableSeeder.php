<?php

use Illuminate\Database\Seeder;
use DOLucasDelivery\Models\User;
use DOLucasDelivery\Models\Client;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 10)->create()->each(function ($user) {
            $user->client()->save(factory(Client::class)->make());
        });
    }
}
