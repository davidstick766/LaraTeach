<?php

use Illuminate\Database\Seeder;

class CampaignCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\CampaignCategory::truncate();
        $faker = \Faker\Factory::create();
        $password = Hash::make('password');
        $types = array('Main Category', 'Sub Category');

        for($i = 0; $i < 20; $i++){
            $type = $types[mt_rand(0, count($types) -1)];
            \App\CampaignCategory::create([
                //'user_id' => mt_rand(1,20),
                'campaign_name' => $faker->word,
                'campaign_type' => $type,
                'cost_per_ad' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 1, $max = 1000),
            ]);
        }
    }
}
