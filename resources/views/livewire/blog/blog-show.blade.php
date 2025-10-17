<div class="container mx-auto px-4 py-8">

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

        {{-- Error State --}}
    @elseif($error)
        <div class="max-w-2xl mx-auto text-center py-20">
            <svg class="w-20 h-20 text-red-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $error }}</h2>
            <p class="text-gray-600 mb-6">لطفاً دوباره تلاش کنید یا به صفحه اصلی بازگردید</p>
            <a href="{{ route('blog.index') }}"
               class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                بازگشت به صفحه اصلی
            </a>
        </div>

        {{-- Post Content --}}
    @elseif($post)
        <div class="max-w-4xl mx-auto">

            {{-- Breadcrumb --}}
            <nav class="mb-6">
                <ol class="flex items-center space-x-2 space-x-reverse text-sm text-gray-600">
                    <li>
                        <a href="{{ route('blog.index') }}" class="hover:text-blue-600 transition-colors">خانه</a>
                    </li>
                    <li>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </li>
                    <li>
                        <a href="{{ route('blog.index') }}" class="hover:text-blue-600 transition-colors">وبلاگ</a>
                    </li>
                    <li>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </li>
                    <li class="text-gray-900 font-medium truncate max-w-xs">{{ $post['title'] }}</li>
                </ol>
            </nav>

            {{-- Post Header --}}
            <article class="bg-white rounded-lg shadow-lg overflow-hidden">

                {{-- Featured Image --}}
                <div class="relative h-96 bg-gradient-to-br from-blue-500 via-purple-600 to-pink-500">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <svg class="w-24 h-24 text-white opacity-50" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>

                    {{-- Status Badge --}}
                    <x-post-status-badge :status="$post['status']"/>
                </div>

                {{-- Post Meta & Content --}}
                <div class="p-8 md:p-12">

                    {{-- Post Title --}}
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 leading-tight">
                        {{ $post['title'] }}
                    </h1>

                    {{-- Post Meta Info --}}
                    <div class="flex flex-wrap items-center gap-4 text-gray-600 mb-8 pb-8 border-b border-gray-200">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 ml-2 text-gray-400" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <span>{{ $post['user']['name'] }}</span>
                        </div>

                        <div class="flex items-center">
                            <svg class="w-5 h-5 ml-2 text-gray-400" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span>{{ \Carbon\Carbon::parse($post['created_at'])->format('Y/m/d') }}</span>
                        </div>

                        <div class="text-sm text-gray-600">
                            <span>#</span> {{ $post['id'] }}
                        </div>


                        @if($post['published_at'])
                            <div class="flex items-center">
                                <svg class="w-5 h-5 ml-2 text-gray-400" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>منتشر شده: {{ \Carbon\Carbon::parse($post['published_at'])->format('Y/m/d') }}</span>
                            </div>
                        @endif
                    </div>

                    {{-- Post Content --}}
                    <div class="prose prose-lg max-w-none">
                        <div class="text-gray-700 leading-relaxed text-justify whitespace-pre-line">
                            {{ $post['content'] }}
                        </div>
                    </div>

                    {{-- Post Footer --}}
                    <div class="mt-12 pt-8 border-t border-gray-200">
                        <div class="flex items-center justify-between">
                            {{--                            <div class="text-sm text-gray-600">--}}
                            {{--                                <span class="font-medium">شناسه پست:</span> {{ $post['id'] }}--}}
                            {{--                            </div>--}}

                            @php
                                $path = $post['category']['ancestors']
                                    ->pluck('name')
                                    ->push($post['category']['name'])
                                    ->implode(' / ');
                            @endphp

                            <div class="flex items-center">
                                <svg class="w-5 h-5 ml-2 text-gray-400" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                                <span class="font-medium">{{ $path }}</span>
                            </div>


                            <a
                                href="{{ route('blog.index') }}"
                                class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
                            >
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                بازگشت به لیست مقالات
                            </a>
                        </div>
                    </div>
                </div>
            </article>

        </div>
    @endif
</div>
