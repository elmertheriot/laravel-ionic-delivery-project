<?php

use Illuminate\Database\Seeder;
use DOLucasDelivery\Models\Order;
use DOLucasDelivery\Models\OrderItem;

class OrderTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Order::class, 10)->create()->each(function ($order) {
            for ($i = 0; $i < 3; $i++) {
                $order->items()->save(factory(OrderItem::class)->make([
                    'product_id' => rand(1, 5),
                    'qty' => 2,
                    'price' => 50
                ]));
            }
        });
    }
}
