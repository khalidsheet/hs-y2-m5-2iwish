<?php

namespace App\Livewire;

use App\Models\Reply;
use Livewire\Component;
use Livewire\WithPagination;

class WishReplies extends Component
{
    use WithPagination;

    public $wish;

    protected $listeners = [
        'replyAdded' => '$refresh',
    ];

    public function render()
    {

        $replies = Reply::query()
            ->with(['user'])
            ->where('feedback_id', $this->wish->id)
            ->isShowable()
            ->orderBy('created_at', 'desc')
            ->paginate(8, ['*'], 'repliesPage');

        $repliesCount = Reply::query()
            ->where('feedback_id', $this->wish->id)
            ->isShowable()
            ->count();

        return view('livewire.wish-replies', ['replies' => $replies, 'replies_count' => $repliesCount]);
    }
}
