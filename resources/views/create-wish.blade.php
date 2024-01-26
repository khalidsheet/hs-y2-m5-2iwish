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
    <div class="my-4 max-w-[600px] mx-auto text-slate-300 dark:bg-slate-800 rounded-lg p-4">
        @livewire('create-new-wish', ['user' => collect($user)->toArray()])
    </div>
</x-app-layout>
