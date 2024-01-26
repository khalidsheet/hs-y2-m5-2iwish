<div class="mb-6">
    <form wire:submit.prevent="createReply" class="flex flex-col w-full gap-x-4">
        <div class="flex flex-1 space-x-2 ">
            <textarea wire:model="reply"
                class="w-full h-12 rounded-lg dark:bg-slate-700 shadow-sm border-gray-800 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                rows="1" placeholder="Write your reply"></textarea>
            <div class="flex">
                <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Reply</button>
            </div>
        </div>
        @error('reply')
            <div class="text-red-500 text-xs mt-2">{{ $message }}</div>
        @enderror
    </form>
</div>
