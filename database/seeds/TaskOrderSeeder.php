<?php

use Illuminate\Database\Seeder;

class TaskOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\TaskOrder::truncate();
        $faker = \Faker\Factory::create();
        $status = array('pending', 'delivered'); 

        for($i = 0; $i < 20; $i++){

            $statuss = $status[mt_rand(0, count($status) -1)];
            \App\TaskOrder::create([
                'task_id' => mt_rand(1,20),
                'publisher_id' => mt_rand(1,20),
                'status' => $statuss,
            ]);
        }
    }
}
