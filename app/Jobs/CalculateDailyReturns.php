<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\Stake;
use App\Models\DailyReturn;
use Illuminate\Support\Facades\Log;

class CalculateDailyReturns implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Get all stakes
        $stakes = Stake::all();
        Log::info('Daily return created for stake ID: ');

        // Calculate the daily return for each stake and insert it into the daily_returns table
        foreach ($stakes as $stake) {
            try {
                $dailyReturnAmount = ($stake->amount * 0.2) / 365;
                $type = $stake->type;
                
                DailyReturn::create([
                    'stake_id' => $stake->id,
                    'daily_return' => $dailyReturnAmount,
                    'type' => $type,
                    'date' => now()->toDateString(),
                ]);

                Log::info('Daily return created for stake ID: ' . $stake->id);
            } catch (\Exception $e) {
                Log::error('Failed to create daily return for stake ID: ' . $stake->id . ' with error: ' . $e->getMessage());
            }
        }
    }
}
