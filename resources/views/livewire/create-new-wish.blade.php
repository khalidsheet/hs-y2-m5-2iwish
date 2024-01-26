<div>
    <h1 class="font-bold text-xl">Write a happy Wish for {{ explode(' ', $user['name'])[0] }}</h1>
    <div class="mt-4">
        <form wire:submit.="createWish">
            <div class="flex flex-col gap-y-4">
                <div class="flex flex-col space-y-2">
                    <label for="message" class="font-bold">Wish Content</label>
                    <textarea rows="6" wire:model="message" id="message" placeholder="{{ $messagePlaceholder }}"
                        class="rounded-lg border-gray-300 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300"></textarea>
                    @error('message')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex flex-col space-y-2">
                    <label for="is_anonymous" class="font-bold">Appear as Anonymous</label>
                    <select wire:model="is_anonymous" id="is_anonymous"
                        class="rounded-lg border-gray-300 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300">
                        <option value="trdue">Yes</option>
                        <option value="fadlse">No</option>
                    </select>
                    @error('is_anonymous')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <button wire:loading.attr="disabled" type="submit"
                        class="px-4 block w-full py-2 bg-indigo-600 text-white rounded-lg shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:bg-slate-900 disabled:cursor-not-allowed">Create</button>

                </div>
            </div>
        </form>
    </div>
    @if (session()->has('success'))
        <div class="mt-4 bg-green-100 text-green-600 font-bold px-4 py-2 rounded-lg">
            {{ session('success') }}
        </div>
    @endif
</div>
