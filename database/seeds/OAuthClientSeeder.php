<?php

use Illuminate\Database\Seeder;
use DOLucasDelivery\Models\OAuthClient;

class OAuthClientSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(OAuthClient::class)->create([
            'id'     => 'appid01',
            'secret' => 'secret',
            'name'   => 'Minha App Mobile'
        ]);
    }
}
