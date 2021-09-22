<?php

use App\Conversation;
use App\ConversationMessage;
use App\Game;
use App\Order;
use App\Product;
use App\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ConversationTableSeeder extends Seeder
{

    private $faker = null;

    public function run()
    {
        $this->faker = Faker::create();
        for ($i = 0; $i < $this->faker->numberBetween(30, 50); $i++) {
            $customer = User::query()->where('type', 'customer')->inRandomOrder()->first();
            $booster = User::query()->where('type', 'booster')->inRandomOrder()->first();
            $conversation = new Conversation();
            $conversation->customer_id = $customer->id;
            $conversation->booster_id = $booster->id;
            $conversation->booster_id = Order::query()->inRandomOrder()->first()->id;
            $conversation->order_id = Order::query()->inRandomOrder()->first()->id;
            $conversation->is_active = $this->faker->numberBetween(0, 1);
            $conversation->save();
            for ($k = 0; $k < $this->faker->numberBetween(50, 250); $k++) {
                $message = new ConversationMessage();
                $message->conversation_id = $conversation->id;
                $message->sender_id = ($this->faker->boolean) ? $booster->id : $customer->id;
                $message->message = $this->faker->sentence($this->faker->numberBetween(1, 20));
                $message->save();
            }
        }
    }
}
