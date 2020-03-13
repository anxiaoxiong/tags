<?php

namespace App\Console;

use App\Http\Controllers\DailyListController;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\QcloudUpload::class,
        Commands\Push::class,
        //Commands\WorkermanCommand::class,
        Commands\RunMonthBudget::class,
        Commands\MsgPush::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function (){
            $dl = new DailyListController();
            $dl -> daidailyListPush();
        })->dailyAt('8:00');
        //$schedule->command('command:qu')-> everyMinute(); //每分钟执行一次
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
