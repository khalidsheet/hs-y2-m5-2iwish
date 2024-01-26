<?php

namespace App\Livewire;

use App\Models\Feedback;
use Livewire\Component;

class WishCard extends Component
{
    public Feedback $wish;
    public $canEditPrivacy = false;

    public $canViewPrivacy = false;

    public $canDelete = false;

    public $canReply = false;

    /**
     * This is used to determine if the wish is for the sender or the receiver.
     */
    public $forSender = false;

    public function mount($wish)
    {
        $this->wish = $wish;
    }



    public function togglePrivacy()
    {
        if ($this->wish->isPublic()) {
            $this->wish->makePrivate();
        } else {
            $this->wish->makePublic();
        }
    }

    public function deleteWish()
    {
        $this->wish->delete();
        $this->dispatch('wishDeleted');
    }

    public function render()
    {
        return view('livewire.wish-card');
    }
}
