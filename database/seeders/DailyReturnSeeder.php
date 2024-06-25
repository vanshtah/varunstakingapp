<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stake;
use App\Models\DailyReturn;
use Carbon\Carbon;

class DailyReturnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stakes = Stake::all();

        foreach ($stakes as $stake) {
            $startDate = Carbon::parse($stake->created_at);
            $endDate = Carbon::now();
            $dailyReturnRate = 2 / 365; // Assuming 0.2% daily return rate

            for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
                $type = $stake->type;
                DailyReturn::create([
                    'stake_id' => $stake->id,
                    'daily_return' => $stake->amount * $dailyReturnRate,
                    'type' => $type,
                    'date' => $date->format('Y-m-d'),
                ]);
            }
        }
    }
}
