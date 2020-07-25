<?php

use Illuminate\Database\Seeder;

class WalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Wallet::truncate();
        $faker = \Faker\Factory::create();
        $ids = range(1,20);
        shuffle($ids);
        for($i = 0; $i < 20; $i++){
            \App\Wallet::create([
                'user_id' => $ids[$i],
                'amount' => $faker->numberBetween($min = 0, $max = 1000000),
            ]);
        }
    }
}
