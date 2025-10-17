<div class="max-w-2xl mx-auto">
    <div class="relative">
        {{-- Search Input --}}
        <input
            type="text"
            wire:model.live.debounce.500ms="search"
            placeholder="{{ $placeholder }}"
            class="w-full px-5 py-4 pr-12 text-gray-900 placeholder-gray-500 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
        >

        {{-- Search Icon --}}
        <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </div>

        {{-- Loading Indicator --}}
        <div wire:loading wire:target="search" class="absolute left-12 top-1/2 transform -translate-y-1/2">
            <svg class="animate-spin h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                      d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>

        {{-- Clear Button --}}
        {{--        @if($search && $showClearButton)--}}
        {{--            <button--}}
        {{--                wire:click="clearSearch"--}}
        {{--                type="button"--}}
        {{--                class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors focus:outline-none"--}}
        {{--                title="پاک کردن جستجو"--}}
        {{--            >--}}
        {{--                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
        {{--                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>--}}
        {{--                </svg>--}}
        {{--            </button>--}}
        {{--        @endif--}}
    </div>

    {{-- Search Hint --}}
    @if(strlen($search) > 0 && strlen($search) < 3)
        <div class="mt-2 text-xs text-gray-500 text-center">
            حداقل 3 کاراکتر برای جستجو وارد کنید
        </div>
    @endif
</div>
