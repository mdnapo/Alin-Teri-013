<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Donation;
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
        $file = "/srv/http/alinteri/app/Console/Storage/mailupdate.json";

        if (file_exists($file)) {
            $status = json_decode(file_get_contents($file), true);
            if (isset($status['contacts'])) {
                $contacts = Contact::where('id', '>', $status['contacts']);
                $status['contacts'] = Contact::orderBy('id', 'desc')->first()->id;
                file_put_contents($file, json_encode($status));
            } else {
                $this->error("Could not parse file correctly.");
            }
            $donations = Donation::where('approved', 0);
            $this->info('Sending mail to:' . env('ADMIN_MAIL', '42in07sol@gmail.com'));

            Mail::send('emails.update', compact('donations', 'contacts'), function ($message) {
                $message->subject('Donatie update');
                $message->from('42in07sol@gmail.com', 'Alinteri | Webmaster');
                $message->to(env('ADMIN_MAIL', '42in07sol@gmail.com'));
                $message->replyTo('42in07sol@gmail.com');
            });
        } else {
            $this->error("Could not find file at location: " . $file);
        }
    }
}

