<?php

namespace App\Listeners;

use App\Jobs\ReplyCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendReplyCreatedEmail implements ShouldQueue
{

    use InteractsWithQueue;

    /**
     * Handle the event.
     */
    public function handle(ReplyCreated $event): void
    {
        Mail::to([$event->reply->feedback->sender, $event->reply->feedback->receiver])->send(new \App\Mail\ReplyCreated($event->reply->feedback));
    }
}
