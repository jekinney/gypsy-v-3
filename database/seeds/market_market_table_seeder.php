<?php

use Carbon\Carbon;
use App\Markets\Market;
use Illuminate\Database\Seeder;

class market_market_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$types = App\Markets\Type::all();
    	$faker = Faker\Factory::create();

    	foreach ($types as $type) {
    		for($count = 0; $count < 11; $count++) {
    			$title = $faker->sentence();
		        Market::create([
		        	'type_id' => $type->id,
		        	'title' => $title,
		        	'slug' => str_slug($title),
		        	'description' => $faker->paragraph,
		        	'start_at' => Carbon::now()->addWeeks($count),
		        	'end_at' => Carbon::now()->addWeeks($count+1),
		        ]);
		    }
		}
    }
}
