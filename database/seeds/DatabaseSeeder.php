<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(user_table_seeder::class);
        $this->call(blog_category_table_seeder::class);
        $this->call(blog_article_table_seeder::class);

        $this->call(market_type_table_seeder::class);
        $this->call(market_market_table_seeder::class);
        $this->call(market_time_table_seeder::class);
    }
}
