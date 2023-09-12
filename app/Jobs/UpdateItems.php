<?php

namespace App\Jobs;

use App\Http\Controllers\API\UpdateItemController;
use App\Models\User;
use App\Notifications\AlertNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Auth;
use Notification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class UpdateItems implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::channel('stderr')->info('...............Items updating task is started...............');
        $updateItemController = new UpdateItemController();
        $updateItemController->run();
        Log::channel('stderr')->info('...............Items updating task completed...............');

        Notification::send($this->user, new AlertNotification('All SKUs are updated successfully', 'updateItems'));
        //$user->notify(new AlertNotification('All SKUs are updated successfully', 'updateItems'));
        Log::channel('stderr')->info('Alert notification sent');

    }
}
