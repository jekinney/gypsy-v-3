<?php

use Carbon\Carbon;
use App\Markets\Time;
use App\Markets\Market;
use Illuminate\Database\Seeder;

class market_time_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $markets = Market::get();

        foreach($markets as $market) {
        	for($count = 0; $count < 7; $count++) {
        		if($count == 0) {
        			$date = $market->start_at;
        		} else {
        			$date = $market->start_at->addDays($count);
        		}
        		Time::create([
        			'market_id' => $market->id,
        			'start' => Carbon::now()->setDate($date->year, $date->month, $date->day)->setTime(07, 00, 00)->toDateTimeString(),
        			'end' => Carbon::now()->setDate($date->year, $date->month, $date->day)->setTime(16, 00, 00)->toDateTimeString(),
        		]);
        	}
        }
    }
}
