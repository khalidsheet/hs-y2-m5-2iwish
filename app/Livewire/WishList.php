<?php

namespace App\Livewire;

use App\Models\Feedback;
use Livewire\Component;
use Livewire\WithPagination;

class WishList extends Component
{

    use WithPagination;

    public $canDelete = false;

    public $canEditPrivacy = false;

    protected $listeners = [
        'wishDeleted' => '$refresh',
    ];

    public $forSender = false;

    public function render()
    {
        return view('livewire.wish-list', [
            'wishes' => Feedback::query()
                ->where($this->forSender ? 'sender_id' : 'receiver_id', auth()->user()->id)
                ->with(['sender', 'receiver', 'replies'])
                ->orderBy('created_at', 'desc')
                ->paginate(8)
        ]);
    }
}
