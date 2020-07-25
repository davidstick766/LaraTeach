<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\User::truncate();
        $faker = \Faker\Factory::create();
        $password = Hash::make('password');
        $genders = array('male', 'female', 'trans', 'others');

        for($i = 0; $i < 20; $i++){
            $gender = $genders[mt_rand(0, count($genders) -1)];
            \App\User::create([
                'first_name' => $faker->name,
                'last_name' => $faker->name,
                'email' => $faker->safeEmail,
                'gender' => $gender,
                'email_verified_at' => $faker->dateTimeThisYear($max = 'now', $timezone = 'Africa/Lagos'),
                'password' => $password,
                'role_id' => mt_rand(1,4),
                'photo_url' => $faker->imageUrl($width = 200, $height = 200),
                'address' => $faker->address,
                'state' => $faker->state,
                'country' => $faker->country,
                'phone_number' => $faker->e164PhoneNumber,
                'email_verify_token' => Str::random(40),
                'remember_token' => Str::random(40),
            ]);
        }
    }
}
