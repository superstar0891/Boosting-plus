<?php

use App\Game;
use App\Order;
use App\OrderLine;
use App\Product;
use App\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class OrdersTableSeeder extends Seeder
{

    private $faker = null;

    public function run()
    {
        $this->faker = Faker::create();
        for ($i = 0; $i < $this->faker->numberBetween(25, 50); $i++) {
            $order = new Order();
            $order->customer_id = User::query()->where('type', 'customer')->inRandomOrder()->first()->id;
            $order->booster_id = User::query()->where('type', 'booster')->inRandomOrder()->first()->id;
            $order->product_id = 1;
            $order->status = $this->faker->randomElement(['Pending', 'Completed', 'Denied', 'Started', 'Claimed']);
            $order->promo_code = null;
            $order->game_system = $this->faker->randomElement(['PC', 'Xbox', 'Playstation']);
            $order->login_email = $this->faker->email;
            $order->login_username = $this->faker->username;
            $order->login_password = $this->faker->password;
            $order->payment_method = "Paypal";
            $order->total_payment_amount = 1000;
            $order->notes = $this->faker->sentence;
            $order->booster_paid = 0;
            $order->save();
            $line = new OrderLine();
            $line->order_id = $order->id;
            $line->addon_id = 1;
            $line->price = 1000;
            $line->save();
        }
    }
}
