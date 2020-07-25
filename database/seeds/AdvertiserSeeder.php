<?php

use Illuminate\Database\Seeder;

class AdvertiserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //
        \App\Advertiser::truncate();
        $faker = \Faker\Factory::create();
        $types = array('individual', 'company'); 
        $acctTypes = array('PRO', 'Normal'); 

        for($i = 0; $i < 20; $i++){
            $type = $types[mt_rand(0, count($types) -1)];
            $acctType = $acctTypes[mt_rand(0, count($acctTypes) -1)];
            \App\Advertiser::create([
                'user_id' => mt_rand(1,20),
                'type' => $type,
                'company_name' => $faker->company,
                'company_address' => $faker->address,
                'company_email' => $faker->companyEmail,
                'company_phone' => $faker->e164PhoneNumber,
                'company_state' => $faker->state,
                'company_size' => mt_rand(2, 1000),
                'company_position' => $faker->jobTitle,
                'account_type' => $acctType,
                'blocked' => mt_rand(0,1),
            ]);
        }
    }
}
