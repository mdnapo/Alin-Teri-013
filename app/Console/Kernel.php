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

        $schedule->call(function () {
            AdminController::donationMail();
        })->when(function () {
            if (file_exists('./Storage/mailupdate.yaml'))
                yaml_parse_file('./Storage/mailupdate.yaml');
            if (Donation::where('approved', 0)->count() > 0)
                return true;
            else if (isset($contacts) && (Contact::all()->count() > $contacts))
                return true;
            else
                return false;
        });
    }
}
