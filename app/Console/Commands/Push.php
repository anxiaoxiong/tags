<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

use App\Notifications\TeacherWithdrawSuccess;
use App\Models\User;

class Push extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:push';

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
//            $arrange = new Arrange();
  //          $arrange -> expire();
        $users = User::find(9);
//        $users->notify(new TeacherLateArrange());
        //$users->notify(new StudentLateLive());
        Notification::send($users, new TeacherWithdrawSuccess());
    }
}
