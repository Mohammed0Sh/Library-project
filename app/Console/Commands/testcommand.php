<?php

namespace App\Console\Commands;

use App\Item;
use App\Mail\notification_for_remind_delivery_borrow;
use App\Mail\notification_for_warning_delivery_borrow;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class testcommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = User::find(2);
        $name = $user->first_name .' '.$user->last_name;
        $item = Item::find(3);
        $title = $item->name;

        $data = [
            'day'=> 5,
            'name' => $name,
            'title' => $title
        ];

        Mail::To($user->email)->send(new notification_for_warning_delivery_borrow($data));
    }
}
