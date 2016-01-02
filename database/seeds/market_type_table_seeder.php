<?php

use App\Markets\Type;
use Illuminate\Database\Seeder;

class market_type_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker\Factory::create();

        Type::create([
        	'title' => 'Rustapalooza',
            'slug' => 'Rustapalooza',
        	'image' => $faker->imageUrl(400, 400),
        	'description' => $faker->paragraph(),
        	'location' => 'Florida',
    	]);

    	Type::create([
        	'title' => 'Vandabond Flea',
            'slug' => 'Vandabond Flea',
        	'image' => $faker->imageUrl(400, 400),
        	'description' => $faker->paragraph(),
        	'location' => 'Florida',
    	]);
    }
}
