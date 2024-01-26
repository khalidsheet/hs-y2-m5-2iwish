<div>
    <div class="text-slate-500 mb-3">{{ $replies_count }} {{ $replies_count === 1 ? 'reply' : 'replies' }} found
        for
        this wish</div>

    @livewire('create-reply-form', ['wish' => $wish])

    @if ($replies->count())
        @foreach ($replies as $reply)
            <div class="mb-6 last:mb-2 border-b border-slate-700 pb-2 last:border-none last:pb-0">
                <div id="user" class="mb-2 flex justify-between">
                    <div class="flex space-x-2">
                        <img src="{{ $reply->user->profile_photo_url }}" class="w-6 h-6 rounded-full" alt="">
                        <div class="flex flex-col">
                            <div>{{ $reply->user->name }}</div>
                            <div class="text-xs text-slate-500">Member since
                                {{ $reply->user->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                    <div class="text-xs text-slate-500">
                        {{ $reply->created_at->diffForHumans() }}
                    </div>
                </div>
                <div id="content" class="pl-8 text-slate-300">
                    {{ $reply->message }}
                </div>
            </div>
        @endforeach
    @endif

    @if ($replies->hasPages())
        <div>
            {{ $replies->links() }}
        </div>
    @endif
</div>
