<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Schedule\UpdateReplaceTime;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('route:list')->dailyAt('12:00');

        // 更新滤芯更换倒计时
        $schedule->call(function (UpdateReplaceTime $updateReplaceTime) {
            $updateReplaceTime->UpdateTime();
        })
        ->name('update_replace_time')
        ->timezone('Asia/Shanghai')
        ->daily();
        // 运行命令
        // php artisan schedule:run
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
