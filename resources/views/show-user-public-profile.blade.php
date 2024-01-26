<x-app-layout>
    <div class="mt-8 mb-4 max-w-[600px] mx-auto text-slate-300 dark:bg-slate-800 rounded-lg">
        <div id="profile" class="flex flex-col items-center justify-center text-center py-4">
            <img src="{{ $user->profile_photo_url }}" class="rounded-full" alt="">
            <div class="mt-3 text-xl font-bold">
                <div class="flex justify-center items-center gap-x-2">
                    {{ $user->name }}
                    @if ($user->created_at->diffInDays() < 29)
                        <div class="text-xs bg-yellow-200 text-yellow-600 px-2 rounded-full">
                            New
                        </div>
                    @endif
                </div>
                <div>
                    <span class="text-sm text-gray-500 dark:text-gray-400">
                        {{ '@' . $user->username }} - Member since {{ $user->created_at->diffForHumans() }}
                    </span>
                </div>
            </div>
            <div class="flex space-x-3 mt-2">
                <div class="bg-green-200 text-green-600 py-1 px-2 rounded-full min-w-28">
                    {{ $user->feedbacks->count() }} Recevied
                </div>
                <div class="bg-slate-200 text-slate-600 py-1 px-2 rounded-full min-w-28">
                    {{ $user->sent->count() }} Sent
                </div>
            </div>
        </div>
    </div>
    @if (auth()->user()->id != $user->id)
        <div
            class="my-4 max-w-[600px] mx-auto text-slate-300 dark:bg-slate-800 rounded-lg flex items-center justify-center">

            <a href="{{ route('user.public-profile.new', ['user' => $user]) }}"
                class="bg-white text-slate-800 my-8 py-2 px-4 rounded-lg font-bold">
                Write a happy Wish for {{ explode(' ', $user->name)[0] }}!
            </a>
        </div>
    @endif
    @livewire('wish-list', ['forSender' => false, 'canDelete' => false, 'canEditPrivacy' => false, 'user' => $user])
</x-app-layout>
