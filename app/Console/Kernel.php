<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Word;
use App\Models\Discussion;
use App\Models\Reply;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * Schedule commands.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('weekly:expire')->weeklyOn(5, '23:59');

        $schedule->call(function () {
            Word::where('is_active', true)
                ->whereDate('published_at', '<', Carbon::today())
                ->update(['is_active' => false]);
        })->dailyAt('00:00');

        $schedule->call(function () {
            Discussion::where('expires_at', '<', now())->delete();
            Reply::where('expires_at', '<', now())->delete();
        })->everyMinute();

        $schedule->command('cleanup:expired')->daily();
    }

 
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
    }
}
