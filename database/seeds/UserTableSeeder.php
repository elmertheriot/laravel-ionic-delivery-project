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
        factory(User::class)->create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => bcrypt('123456'),
            'remember_token' => str_random(10),
        ])->client()->save(factory(Client::class)->make());

        factory(User::class)->create([
            'name' => 'Admin',
            'email' => 'admin@user.com',
            'password' => bcrypt('123456'),
            'remember_token' => str_random(10),
            'role' => 'admin',
        ])->client()->save(factory(Client::class)->make());

        factory(User::class, 10)->create()->each(function ($user) {
            $user->client()->save(factory(Client::class)->make());
        });

        factory(User::class, 3)->create([
            'role' => 'deliveryman'
        ]);
    }
}
