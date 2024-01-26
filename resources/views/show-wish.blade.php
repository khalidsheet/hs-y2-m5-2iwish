<x-app-layout>
    <div class="text-white max-w-[600px] mx-auto mt-4 dark:bg-slate-800 rounded-lg p-4">
        <div id="user" class="pb-2 mb-2 flex items-start justify-between">
            <div class="flex items-center space-x-3">
                <div>
                    @if ($wish->is_anonymous)
                        <x-application-mark class="block h-9 w-auto" />
                    @else
                        <img class="rounded-full w-10 h-10 inline-block" src="{{ $wish->receiver->profile_photo_url }}"
                            alt="">
                    @endif
                </div>
                <div class="flex flex-col">
                    <div class="text-lg">
                        {{-- {{ !$forSender && $wish->is_anonymous ? 'Anonymous' : $wish->sender->name }} --}}

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
                    </div>
                    <div class="dark:text-gray-500">
                        {{ $wish->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>
            <div
                class="text-sm mt-1 px-3 rounded-full py-1 font-bold {{ $wish->is_public ? 'bg-green-300 text-green-600 ' : 'bg-slate-300 text-slate-600' }}">
                {{ $wish->is_public ? 'Public' : 'Private' }}
            </div>
        </div>
        <div id="content" class="border-b pb-2 mb-2 border-slate-700">
            {{ $wish->message }}
        </div>
        <div id="replies">
            @livewire('wish-replies', ['wish' => $wish])
        </div>
    </div>
</x-app-layout>
