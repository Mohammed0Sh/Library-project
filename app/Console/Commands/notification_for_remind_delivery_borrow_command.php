<?php

namespace App\Console\Commands;

use App\Borrow;
use App\Site_Setting;
use Illuminate\Console\Command;

use App\Mail\notification_for_remind_delivery_borrow;
use App\Mail\notification_for_warning_delivery_borrow;



class notification_for_remind_delivery_borrow_command extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SendMail:NotificationForRemindDeliveryBorrow';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'notification for remind users who remain to ther borrows a certain number of days to delivery the item';

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
        $num_day_cancel_reservation = Site_Setting::where(['name'=>'num_day_to_return_borrow'])->first();
        $int = (int)$num_day_cancel_reservation->value;

        $borrows = Borrow::select()->where('borrow_state_id',3)->get();

        if ($borrows != null)
        {
            foreach ($borrows as $borrow)
            {
                if ( ($borrow -> return_date - $int) <= time())
                {
                    $user = $borrow->getUser;
                    $name = $user->first_name .' '.$user->last_name;

                    $item = $borrow->getItem;
                    $title = $item->name;



                    if (time() > return_date)
                    {
                        $day = (int)time() - $borrow->return_date;

                        $data = [
                            'day'=> 5,
                            'name' => $name,
                            'title' => $title
                        ];
                        Mail::to($user->email)->send(new notification_for_warning_delivery_borrow($data));
                    }
                    else
                    {
                        $day = (int)$borrow->return_date-time();

                        $data = [
                            'day'=> 5,
                            'name' => $name,
                            'title' => $title
                        ];

                        Mail::to($user->email)->send(new notification_for_remind_delivery_borrow($data));
                    }
                }
            }
        }


    }
}
