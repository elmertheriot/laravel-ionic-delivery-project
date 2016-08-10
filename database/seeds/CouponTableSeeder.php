<?php

use Illuminate\Database\Seeder;
use DOLucasDelivery\Models\Coupon;
use DOLucasDelivery\Models\Product;

class CouponTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Coupon::class, 10)->create();
    }
}
