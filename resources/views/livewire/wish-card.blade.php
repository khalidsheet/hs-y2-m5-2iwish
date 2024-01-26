<div class="dark:bg-gray-800 dark:text-gray-200 rounded-lg  mb-4 max-w-[600px] mx-auto">
    <div id="header" class=" border-b dark:border-gray-700 px-4 py-2 flex items-start justify-between">
        <div class="flex items-center space-x-3">
            <div>
                @if (!$forSender && $wish->is_anonymous)
                    <x-application-mark class="block h-9 w-auto" />
                @else
                    <img class="rounded-full w-10 h-10 inline-block"
                        src="{{ $forSender ? $wish->receiver->profile_photo_url : $wish->sender->profile_photo_url }}"
                        alt="">
                @endif
            </div>
            <div class="flex flex-col">
                <div class="text-lg">
                    {{-- {{ !$forSender && $wish->is_anonymous ? 'Anonymous' : $wish->sender->name }} --}}
                    @if ($forSender)
                        You
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            to <a href="{{ route('user.public-profile', ['user' => $wish->receiver]) }}"
                                class="text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-500"
                                target="_blank">
                                ({{ $wish->receiver->username }})
                            </a>
                        </span>
                    @else
                        @if ($wish->is_anonymous)
                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                Anonymous
                            </span>
                        @else
                            {{ $wish->sender->name }}
                        @endif
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            <a href="{{ route('user.public-profile', ['user' => $wish->sender]) }}"
                                class="text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-500"
                                target="_blank">
                                ({{ $wish->sender->username }})
                            </a>
                        </span>
                    @endif
                </div>
                <div class="dark:text-gray-500">
                    {{ $wish->created_at->diffForHumans() }}
                </div>
            </div>
        </div>
        @if ($canViewPrivacy)
            <div>
                <div
                    class="text-sm mt-1 px-3 rounded-full py-1 font-bold {{ $wish->is_public ? 'bg-green-300 text-green-600 ' : 'bg-slate-300 text-slate-600' }}">
                    {{ $wish->is_public ? 'Public' : 'Private' }}
                </div>
            </div>
        @endif
    </div>

    <div id="content" class="p-4 ">
        {{ $wish->message }}
    </div>
    <div id="footer" class="border-t dark:border-gray-700 px-4 py-4 flex items-center justify-between">
        <div>
            <div class="text-sm text-gray-500 dark:text-gray-400">
                {{ $wish->replies->count() }} {{ $wish->replies->count() == 1 ? 'reply' : 'replies' }}
            </div>
        </div>
        <div class="flex space-x-2">
            @if ($canReply || !$forSender)
                <a href="{{ route('show-wish', ['wish' => $wish]) }}">
                    <x-button class="dark:bg-indigo-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-4 h-4 text-indigo-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" />
                        </svg>
                    </x-button>
                </a>
            @else
            @endif
            @if ($canEditPrivacy)
                <div class="flex items-center space-x-3"
                    title="{{ !$wish->is_public ? 'Make Public' : 'Make Private' }}">
                    <x-button wire:click="togglePrivacy()">
                        @if ($wish->is_public)
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        @endif
                    </x-button>
                </div>
            @endif
            @if ($canDelete || auth()->user()->id === $wish->sender_id)
                <div class="flex items-center space-x-3">
                    <x-button wire:click="deleteWish()" class="dark:bg-red-200">
                        <span class="dark:text-red-600"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </span>
                    </x-button>
                </div>
            @endif
        </div>
    </div>

</div>
