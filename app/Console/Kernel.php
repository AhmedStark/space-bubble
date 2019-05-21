<?php

namespace App\Console;

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
        $schedule->call(function () {
            $buildings=Building::all()->get();
            foreach ($buildings as $building){
                $levels=$building->levels()->get();
                foreach($levels as $level){
                    $areas=$level->areas()->get();
                    foreach ($areas as $area){
                        $area_id=$area->id;
                        $areaTotalNumbOfTables=areaController::totalTables($area_id);
                        $areaTotalNumbOfTakenTables=areaController::totalTakenTables($area_id);
                        
                    }
                }
            }

        })->hourly();
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
