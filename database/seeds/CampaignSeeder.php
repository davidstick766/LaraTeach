<?php

use Illuminate\Database\Seeder;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Campaign::truncate();
        $faker = \Faker\Factory::create();
        $password = Hash::make('password');
        $types = array('Public', 'Private');

        for($i = 0; $i < 20; $i++){
            $type = $types[mt_rand(0, count($types) -1)];
            $number = 1;
            \App\Campaign::create([
                'user_id' => mt_rand(1,20),
                'advertiser_id' => mt_rand(1,20),
                //'campaign_type' => $type,
                //'campaign_name' => $faker->word,
                'campaign_about' => $faker->text($maxNbChars = 100),
                'category_id' => mt_rand(1,20),
                'is_approved' => $faker->numberBetween($min = 0, $max = 1),
            ]);
        }
    }
}
