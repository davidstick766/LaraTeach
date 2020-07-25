<?php

use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Transaction::truncate();
        $faker = \Faker\Factory::create();
        $status = array('pending', 'paid', 'rejected');
        $payTypes = array('bank account', 'wallet', 'card');
        $types = array('sent', 'received');

        for($i = 0; $i < 20; $i++){
            $statuss = $status[mt_rand(0, count($status) -1)];
            $payType = $payTypes[mt_rand(0, count($payTypes) -1)];
            $type = $types[mt_rand(0, count($types) -1)];
            \App\Transaction::create([
                'user_id' => mt_rand(1,20),
                'type' => $type,
                'amount' => $faker->numberBetween($min = 0, $max = 1000000),
                'currency' => $faker->currencyCode, 
                'transaction_ref' => Str::random(10),
                'transaction_desc' => $faker->text($maxNbChars = 100),
                'transaction_status' => $statuss,
                'payment_type' => $payType,
            ]);
        }
    }
}
