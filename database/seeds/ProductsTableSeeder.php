<?php

use App\Game;
use App\Product;
use App\ProductAddOn;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductsTableSeeder extends Seeder
{

    private $faker = null;

    public function run()
    {
        $this->faker = Faker::create();
        $owLeveling = new Product();
        $owLeveling->game_id = Game::query()->where('game_name', 'CS-GO')->first()->id;
        $owLeveling->setTranslation('name', 'en', 'Leveling');
        $owLeveling->setTranslation('name', 'ar', 'الإستواء');
        $owLeveling->setTranslation('short_description', 'en', 'This power leveling service allows for rapid leveling');
        $owLeveling->setTranslation('short_description', 'ar', 'تسمح هذه الخدمة لتسوية الطاقة بالتسوية السريعة');
        $owLeveling->setTranslation('description', 'en', 'Are you tired of getting levels by yourself? Would you prefer if one of our team handled it for you? You can do so with this service! Sit back and let us do the hard work!');
        $owLeveling->setTranslation('description', 'ar', 'هل أنت متعب من الحصول على مستويات من نفسك؟ هل تفضل لو قام أحد فريقنا بالتعامل معه نيابة عنك؟ يمكنك القيام بذلك مع هذه الخدمة! اجلس ودعنا نفعل العمل الشاق!');
        $owLeveling->image = "nine.png";
        $owLeveling->price = 4.50;
        $owLeveling->save();

        $addon = new ProductAddOn();
        $addon->product_id = $owLeveling->id;
        $addon->type = "Checkbox";
        $addon->setTranslation('name', 'en', 'Stream Service?');
        $addon->setTranslation('name', 'ar', 'Stream Service?');
        $addon->price_in_percent = 50;
        $addon->setTranslation('description', 'en', 'We will stream this service for you!');
        $addon->setTranslation('description', 'ar', 'We will stream this service for you!');
        $addon->save();

    }
}
