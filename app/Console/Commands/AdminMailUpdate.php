<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Contact;

class AdminMailUpdate extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:mailupdate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a mail update to the Administrator';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $this->info("Ran!");
    }
}
