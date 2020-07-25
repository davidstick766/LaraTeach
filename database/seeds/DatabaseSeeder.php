<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(TransactionSeeder::class);
        $this->call(PublisherSeeder::class);
        $this->call(AdvertiserSeeder::class);
        $this->call(CampaignCategorySeeder::class);
        $this->call(CampaignSeeder::class);
        $this->call(PubSocialMediaSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(TaskOrderSeeder::class);
        $this->call(WalletSeeder::class);
        $this->call(WithdrawalSeeder::class);
    }
}
