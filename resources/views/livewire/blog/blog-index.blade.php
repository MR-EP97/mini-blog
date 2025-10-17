<div class="container mx-auto px-4 py-8">

    {{-- Page Header --}}
    <div class="mb-8 text-center">
        <h1 class="text-4xl font-bold text-gray-900 mb-2">وبلاگ</h1>
        <p class="text-gray-600">آخرین مقالات و اخبار</p>
    </div>

    {{-- Search Box --}}
    <div class="mb-10">
        @livewire('blog.search-bar')

        {{-- Search Results Info --}}
        @if($search && !$isLoading)
            <div class="mt-3 text-sm text-gray-600 text-center">
                <span class="font-medium">{{ number_format($pagination['total'] ?? 0) }}</span> نتیجه برای
                <span class="font-medium">"{{ $search }}"</span>
            </div>
        @endif
    </div>

    {{-- Search Box --}}
    {{--    <div class="max-w-2xl mx-auto mb-10">--}}
    {{--        <div class="relative">--}}
    {{--            <input--}}
    {{--                type="text"--}}
    {{--                wire:model.debounce.500ms="loadPosts"--}}
    {{--                placeholder="جستجو در مقالات..."--}}
    {{--                class="w-full px-5 py-4 pr-12 text-gray-900 placeholder-gray-500 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"--}}
    {{--            >--}}

    {{--            --}}{{--            Search Icon--}}
    {{--            <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400">--}}
    {{--                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
    {{--                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
    {{--                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>--}}
    {{--                </svg>--}}
    {{--            </div>--}}

    {{--            --}}{{--            Clear Button--}}
    {{--            @if($search)--}}
    {{--                <button--}}
    {{--                    wire:click="clearSearch"--}}
    {{--                    class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors"--}}
    {{--                >--}}
    {{--                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
    {{--                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>--}}
    {{--                    </svg>--}}
    {{--                </button>--}}
    {{--            @endif--}}
    {{--        </div>--}}

    {{--        --}}{{--        Search Results Info--}}
    {{--        @if($search && !$isLoading)--}}
    {{--            <div class="mt-3 text-sm text-gray-600 text-center">--}}
    {{--                <span class="font-medium">{{ number_format($pagination['total'] ?? 0) }}</span> نتیجه برای--}}
    {{--                <span class="font-medium">"{{ $search }}"</span>--}}
    {{--            </div>--}}
    {{--        @endif--}}
    {{--    </div>--}}

    {{-- Loading State --}}
    @if($isLoading)
        <div class="flex justify-center items-center py-20">
            <div class="flex flex-col items-center">
                <svg class="animate-spin h-12 w-12 text-blue-600 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <p class="text-gray-600">در حال بارگذاری...</p>
            </div>
        </div>
    @else
        {{-- Posts Grid --}}
        @if(count($posts) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                @foreach($posts as $post)
                    <x-blog.post-card :post="$post"/>
                @endforeach
            </div>


            {{-- Pagination --}}
            @if($pagination['last_page'] > 1)
                <div class="flex justify-center items-center space-x-2 space-x-reverse">

                    @foreach($pagination['links'] as $link)
                        @if($link['page'] ?? 0 && $link['label'] !== '...')
                            <button
                                wire:click="gotoPage({{ $link['page'] }})"
                                class="px-4 py-2 rounded-lg transition-colors {{ $link['active'] ? 'bg-blue-600 text-white' : 'bg-white border border-gray-300 hover:bg-gray-50' }}"
                            >
                                {!!  $link['label'] !!}
                            </button>
                        @elseif($link['label'] === '...')
                            <span class="px-2 text-gray-500">...</span>
                        @endif
                    @endforeach

                </div>

                {{--                Pagination Info--}}
                <div class="text-center mt-4 text-sm text-gray-600">
                    نمایش {{ number_format($pagination['from']) }} تا {{ number_format($pagination['to']) }}
                    از {{ number_format($pagination['total']) }} مقاله
                </div>
            @endif
        @else
            No Results
            <div class="text-center py-20">
                <svg class="w-20 h-20 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">نتیجه‌ای یافت نشد</h3>
                <p class="text-gray-600 mb-4">متاسفانه هیچ مقاله‌ای با این جستجو پیدا نشد</p>
                @if($search)
                    <button
                        wire:click="clearSearch"
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
                    >
                        پاک کردن جستجو
                    </button>
                @endif
            </div>
        @endif
    @endif

    {{--     Error Message--}}
    @if(session()->has('error'))
        <div class="fixed bottom-4 left-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg">
            {{ session('error') }}
        </div>
    @endif
</div>
