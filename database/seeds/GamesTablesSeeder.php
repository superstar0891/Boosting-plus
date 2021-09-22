<?php

use App\Game;
use App\User;
use Illuminate\Database\Seeder;

class GamesTablesSeeder extends Seeder
{

    public function run()
    {
          $csgo = new Game();
          $csgo->image = "csgo.jpg";
          $csgo->game_name = "CS-GO";
          $csgo
                ->setTranslation('description', 'en', 'Counter-Strike: Global Offensive (CS:GO) is a multiplayer first-person shooter developed by Valve and Hidden Path Entertainment. It is the fourth game in the Counter-Strike series and was released for Windows, OS X, Xbox 360, and PlayStation 3 in August 2012, while the Linux version was released in 2014.')
                ->setTranslation('description', 'ar', 'لعبة Counter-Strike: Global Offensive (CS: GO) هي لعبة إطلاق نار متعددة اللاعبين تم تطويرها بواسطة Valve and Hidden Path Entertainment. إنها اللعبة الرابعة في سلسلة Counter-Strike وتم إصدارها لأنظمة Windows و OS X و Xbox 360 و PlayStation 3 في أغسطس 2012 ، بينما تم إصدار إصدار Linux في عام 2014.')
                ->save();

        $overwatch = new Game();
        $overwatch->game_name = "Overwatch";
        $overwatch->setTranslation('description', 'en', "Overwatch is a vibrant team-based shooter set on a near-future earth. Every match is an intense 6v6 battle between a cast of unique heroes, each with their own incredible powers and abilities. Clash in over 20 maps from across the globe, and switch heroes on the fly to adapt to the ever-changing situation on the field.");
        $overwatch->image = "overwatch.jpg";
        $overwatch->setTranslation('description', 'ar', "Overwatch هو مطلق النار النابض بالحياة القائم على الفريق والموجود على أرض قريبة من المستقبل. كل مباراة هي معركة 6v6 مكثفة بين مجموعة من الأبطال الفريدين ، كل منهم يتمتع بقدراتهم وقدراتهم المذهلة. اشتبك في أكثر من 20 خريطة من جميع أنحاء العالم ، وقم بتبديل الأبطال أثناء الطيران للتكيف مع الوضع المتغير دائمًا في هذا المجال.");
        $overwatch->save();

        $league = new Game();
        $league->game_name = "League of Legends";
        $league->setTranslation('description', 'en',"League of Legends is a multiplayer online battle arena video game developed and published by Riot Games for Microsoft Windows and macOS. Inspired by the Warcraft III: The Frozen Throne mod Defense of the Ancients, the game follows a freemium model and is supported by microtransactions.");
        $league->image = "league.jpg";
        $league->setTranslation( 'description', 'ar', "League of Legends هي لعبة فيديو متعددة ساحة المعركة عبر الإنترنت تم تطويرها ونشرها من قبل Riot Games for Microsoft Windows و macOS. مستوحاة من Warcraft III: The Frozen Throne mod Defense of the Ancients ، تتبع اللعبة نموذج فريميوم وتدعمه المعاملات الدقيقة.");
        $league->save();

        $destiny2 = new Game();
        $destiny2->game_name = "Destiny 2";
        $destiny2->setTranslation('description', 'en',"Destiny 2 is a free-to-play online-only multiplayer first-person shooter video game developed by Bungie. It was released for PlayStation 4 and Xbox One on September 6, 2017, followed by a Microsoft Windows version the following month.");
        $destiny2->image = "destiny2.jpg";
        $destiny2->setTranslation('description', 'ar', "لعبة Destiny 2 هي لعبة فيديو إطلاق نار أول شخص متعدد اللاعبين يتم تطويرها مجانًا على الإنترنت ، والتي طورتها Bungie. تم إصداره من أجل PlayStation 4 و Xbox One في 6 سبتمبر 2017 ، يليه إصدار Microsoft Windows في الشهر التالي.");
        $destiny2->save();

        $pubG = new Game();
        $pubG->game_name = "PlayerUnknown's Battlegrounds";
        $pubG->setTranslation('description', 'en', "PlayerUnknown's Battlegrounds is an online multiplayer battle royale game developed and published by PUBG Corporation, a subsidiary of South Korean video game company Bluehole.");
        $pubG->image = "pubg.jpg";
        $pubG->setTranslation('description', 'ar', "تعد لعبة PlayerUnknown's Battlegrounds لعبة رويال رويال متعددة اللاعبين للمعركة تم تطويرها ونشرها بواسطة شركة PUBG Corporation ، وهي شركة تابعة لشركة Bluehole لألعاب الفيديو الكورية الجنوبية.");
        $pubG->save();
    }
}
