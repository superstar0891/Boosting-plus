<?php

use App\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    private $faker = null;
    public function run()
    {
        $this->faker = Faker::create();
        $administrator = new User;
        $administrator->name = 'Administrator';
        $administrator->email = 'admin@example.com';
        $administrator->password = bcrypt('secret');
        $administrator->type = "Administrator";
        $administrator->gives_marketing_consent = 1;
        $administrator->save();

        for ($i = 0; $i < $this->faker->numberBetween(5, 15); $i++) {
            $booster = new User;
            $booster->name = $this->faker->name;
            $booster->email = $this->faker->email;
            $booster->password = $this->faker->password;
            $booster->type = "Booster";
            $booster->gives_marketing_consent = 1;
            $booster->save();
        }

        for ($k = 0; $k < $this->faker->numberBetween(50, 250); $k++) {
            $customer = new User;
            $customer->name = $this->faker->email;
            $customer->email = $this->faker->email;
            $customer->password = $this->faker->password;
            $customer->type = "Customer";
            $customer->gives_marketing_consent = 1;
            $customer->save();
        }
    }
}