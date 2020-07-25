<?php

use Illuminate\Database\Seeder;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Publisher::truncate();
        $faker = \Faker\Factory::create();
        $password = Hash::make('password');
        $types = array('Individual', 'Company');
        $niches = array('Adult', 'Football', 'Movies', 'Children', 'Entertainment', 'Others');

        for($i = 0; $i < 20; $i++){
            $type = $types[mt_rand(0, count($types) -1)];
            $niche = $niches[mt_rand(0, count($niches) -1)];
            \App\Publisher::create([
                'user_id' => mt_rand(1,20),
                'account_type' => $type,
                //'ad_bidding' => $faker->numberBetween($min = 1000, $max = 1000000),
                'followers_amount' => $faker->randomDigitNotNull,
                'niche' => $niche,
                'is_blocked' => $faker->numberBetween($min = 0, $max = 1),
            ]);
        }
    }
}
