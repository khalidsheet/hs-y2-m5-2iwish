<div>
    <div class="max-w-[600px] mx-auto mb-4">
        {{ $wishes->links() }}
    </div>
    @if ($wishes->count() == 0)
        <div
            class="text-center max-w-[600px] mx-auto text-gray-500 dark:text-gray-400 dark:bg-slate-800 flex flex-col items-center rounded-lg p-4 dropshadow-lg">
            <div class="w-24 h-24">
                @if ($forSender)
                    <svg width="800px" height="800px" viewBox="0 0 24 24" class="h-24 w-24 stroke-indigo-600" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M9.47963 6.8252C7.66038 7.50672 6.75075 7.84748 6.641 8.55405C6.53124 9.26062 7.29404 9.86506 8.81965 11.0739L9.21434 11.3867C9.64787 11.7302 9.86464 11.902 9.9889 12.1361C10.1132 12.3702 10.1309 12.6402 10.1662 13.1801L10.1984 13.6717C10.3229 15.5717 10.3852 16.5217 11.0438 16.8493C11.7024 17.1768 12.5212 16.6649 14.1588 15.6412L14.5825 15.3763C15.0479 15.0854 15.2805 14.9399 15.5467 14.8999C15.8128 14.86 16.0822 14.93 16.621 15.07L17.1116 15.1975C19.0078 15.6903 19.9559 15.9367 20.4727 15.4325C20.9895 14.9284 20.7328 14.0076 20.2193 12.166M20.6654 9.29403C21.7128 7.69854 22.2365 6.90079 21.8973 6.26168C21.5581 5.62258 20.5806 5.56537 18.6256 5.45095L18.1198 5.42135C17.5643 5.38884 17.2865 5.37259 17.0452 5.25261C16.804 5.13263 16.6265 4.9225 16.2716 4.50226L15.9486 4.11967C14.6997 2.64083 14.0753 1.90141 13.3488 2.01056C12.6224 2.11971 12.275 3.00516 11.5803 4.77604"
                            stroke-width="1.5" stroke-linecap="round" />
                        <path
                            d="M6.59527 8.55078C3.48192 10.6857 1.09828 14.7691 2.33125 21.9998C3.42268 18.9857 6.71261 16.5716 10.3877 15.4097"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                @else
                    <svg width="800px" height="800px" viewBox="0 0 24 24" fill="none"
                        class="h-24 w-24 stroke-indigo-600" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8.32181 14.4933C7.3798 15.9862 6.90879 16.7327 7.22969 17.3433C7.55059 17.9538 8.45088 18.0241 10.2514 18.1647L10.7173 18.201C11.2289 18.241 11.4848 18.261 11.7084 18.3785C11.9321 18.4961 12.0983 18.6979 12.4306 19.1015L12.7331 19.469C13.9026 20.8895 14.4873 21.5997 15.1543 21.5084C15.8213 21.417 16.1289 20.5846 16.7439 18.9198L16.9031 18.4891C17.0778 18.0161 17.1652 17.7795 17.3369 17.6078C17.5086 17.4362 17.7451 17.3488 18.2182 17.174L18.6489 17.0149C20.3137 16.3998 21.1461 16.0923 21.2374 15.4253C21.3288 14.7583 20.6185 14.1735 19.1981 13.0041M17.8938 10.5224C17.7532 8.72179 17.6829 7.8215 17.0723 7.5006C16.4618 7.1797 15.7153 7.65071 14.2224 8.59272L13.8361 8.83643C13.4119 9.10412 13.1998 9.23797 12.9554 9.27143C12.7111 9.30488 12.4622 9.23416 11.9644 9.09271L11.5113 8.96394C9.75959 8.46619 8.88375 8.21732 8.41508 8.68599C7.94641 9.15467 8.19528 10.0305 8.69303 11.7822"
                            stroke-width="1.5" stroke-linecap="round" />
                        <path d="M13.5 6.5L13 6M9.5 2.5L11.5 4.5" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M6.5 6.5L4 4" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M6 12L4.5 10.5M2 8L2.5 8.5" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                @endif
            </div>
            <div class="text-2xl mt-8 font-bold dark:text-slate-300">
                No wishes yet!
            </div>
            <div class="text-lg">
                @if ($forSender)
                    You haven't sent any wishes yet! Send a happy wish to someone to get started!
                @else
                    Share your public profile link with your friends and family to start receiving wishes!
                @endif
            </div>
            @if (!$forSender)
                <div class="mt-4 dark:bg-slate-100 py-1 px-4 rounded-lg">
                    <a href="{{ route('user.public-profile', ['user' => Auth::user()]) }}" target="_blank"
                        class="text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-500">
                        {{ route('user.public-profile', ['user' => Auth::user()]) }}
                    </a>
                </div>
            @endif
    @endif

    @foreach ($wishes as $wish)
        @livewire('wish-card', ['wish' => $wish, 'canEditPrivacy' => !$forSender && $canEditPrivacy, 'canViewPrivacy' => !$forSender && $canEditPrivacy, 'forSender' => $forSender, 'canDelete' => $canDelete], key($wish->id))
    @endforeach

    <div class="max-w-[600px] mx-auto">
        {{ $wishes->links() }}
    </div>
</div>
