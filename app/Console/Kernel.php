<?php

namespace App\Console;

use App\Contact;
use app\Http\Controllers\Admin\AdminController;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Donation;

class Kernel extends ConsoleKernel {
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Commands\Inspire::class,
        Commands\AdminMailUpdate::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule) {
        // $schedule->command('inspire')
        //          ->hourly();

        $schedule->command('admin:emailupdate')->twiceDaily(9, 16)->when(function () {
            $file = "/srv/http/alinteri/app/Console/Storage/mailupdate.json";
            if (file_exists($file)) {
                $status = json_decode(file_get_contents($file), true);
                if (isset($status['contacts']) && ($status['contacts'] (Contact::orderBy('id', 'desc')->first() != null) && < (Contact::orderBy('id', 'desc')->first()->id))) {
                    return true;
                }
            }
            if (Donation::where('approved', 0)->count() > 0) {
                return true;
            }
            return false;
        }
        );
    }
}
