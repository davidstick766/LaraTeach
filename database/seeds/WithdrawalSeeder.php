<?php

use Illuminate\Database\Seeder;

class WithdrawalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Withdrawal::truncate();
        $faker = \Faker\Factory::create();
        $status = array('pending', 'paid', 'rejected'); 

        for($i = 0; $i < 20; $i++){

            $statuss = $status[mt_rand(0, count($status) -1)];
            \App\Withdrawal::create([
                'user_id' => mt_rand(1,20),
                'amount' => $faker->numberBetween($min = 0, $max = 1000000),
                'status' => $statuss,
            ]);
        }
    }
}
