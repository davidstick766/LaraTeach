<?php

use Illuminate\Database\Seeder;

class PubSocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\PublisherSocialMedia::truncate();
        $faker = \Faker\Factory::create();
        $socialTypes = array('Facebook', 'Twitter', 'Instagram', 'Itunes','Youtube', 'Google+'); 

        for($i = 0; $i < 20; $i++){

            $socialmedia = $socialTypes[mt_rand(0, count($socialTypes) -1)];
            \App\PublisherSocialMedia::create([
                'user_id' => mt_rand(1,20),
                'publisher_id' => mt_rand(1,20),
                'social_media_name' => $faker->name, 
                'social_media_type' => $socialmedia,
                'social_media_url' => 'https://example.com/johndoe',
                'is_verified' => $faker->numberBetween($min = 0, $max = 1),
            ]);
        }
    }
}
