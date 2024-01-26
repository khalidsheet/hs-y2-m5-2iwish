<?php

namespace App\Jobs;

use App\Models\Reply;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ReplyCreated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public function __construct(public Reply $reply)
    {
    }



    public function handle(): void
    {
        Mail::to([$this->reply->feedback->sender, $this->reply->feedback->receiver])->send(new \App\Mail\ReplyCreated($this->reply->feedback));
    }
}
