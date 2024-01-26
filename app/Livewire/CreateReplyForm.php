<?php

namespace App\Livewire;

use Livewire\Component;

class CreateReplyForm extends Component
{

    public $wish;

    public string $reply = '';

    protected $rules = [
        'reply' => 'required|min:3'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function createReply()
    {
        $this->validate();

        $this->wish->replies()->create([
            'user_id' => auth()->user()->id,
            'message' => $this->reply,
            'is_public' => true,
            'is_reported' => false,
        ]);

        $this->reply = '';

        $this->dispatch('replyAdded');
    }

    public function render()
    {
        return view('livewire.create-reply-form');
    }
}
