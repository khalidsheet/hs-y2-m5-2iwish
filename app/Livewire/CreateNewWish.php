<?php

namespace App\Livewire;

use App\Models\Feedback;
use App\Services\Quotes\QuotesService;
use Livewire\Component;

class CreateNewWish extends Component
{
    public $user;

    public $message;

    public $is_anonymous = false;

    public $messagePlaceholder;

    public function mount()
    {
        $this->messagePlaceholder = QuotesService::getQuote();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public $rules = [
        'message' => 'required|min:3',
        'is_anonymous' => 'required'
    ];


    public function createWish()
    {
        $this->validate();

        Feedback::create([
            'sender_id' => auth()->user()->id,
            'receiver_id' => $this->user['id'],
            'message' => $this->message,
            'is_anonymous' => $this->is_anonymous,
            'is_public' => false,
        ]);

        $this->message = '';

        session()->flash('success', 'Wish created successfully.');
    }



    public function render()
    {
        return view('livewire.create-new-wish');
    }
}
